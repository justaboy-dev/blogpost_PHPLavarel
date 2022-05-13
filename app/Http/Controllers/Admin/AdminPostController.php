<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use App\Models\Image;


class AdminPostController extends Controller
{
    public function index(Request $request)
    {
        $per_page = $request->has('per_page') ? $request->get('per_page') : 10;
        $posts = Post::when($request->has("tittle"),function($q)use($request){
            return $q->where("tittle","like","%".$request->get("tittle")."%");
        })->get();
        if($request->ajax()) {
            return view('admin_dashboard.posts.paginate', compact('posts'))->render();
        }
        return view('admin_dashboard.posts.index', compact('posts'));
    }
    public function create()
    {
        $category = Category::all();
        $tags = Tag::all();
        return view('admin_dashboard.posts.create',[
            'categories' => $category,
            'tags' => $tags
        ]);
    }
    public function store(Request $request)
    {
        $data = array();
        $data['error'] = [];
        $data['success'] = 0;
        $rules = [
            'tittle' => 'required|min:3|max:255',
            'body' => 'required|min:3',
            'excerpt' =>'required',
            'category_id' => 'required',
            'slug' => 'required|unique:posts',
            'tags' => 'required',
            'public' => 'required',
            'post_thumb' => 'required',
        ];
        $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {
            $data['error']['tittle'] = $validate->errors()->first('tittle');
            $data['error']['body'] = $validate->errors()->first('body');
            $data['error']['excerpt'] = $validate->errors()->first('excerpt');
            $data['error']['category_id'] = $validate->errors()->first('category_id');
            $data['error']['tags'] = $validate->errors()->first('tags');
            $data['error']['public'] = $validate->errors()->first('public');
            $data['error']['post_thumb'] = $validate->errors()->first('post_thumb');
            $data['message'] = 'Please check the form again';
        } else {
            $attribute = $validate->validated();
            $attribute['user_id'] = auth()->user()->id;
            // dd($attribute);
            $data['success'] = 1;
            $data['message'] = 'Create post successfully';
            $post = Post::create($attribute);
            $post->tags()->sync(explode(',',$attribute['tags']));
            $image = Image::where('path',substr($attribute['post_thumb'],1))->first();
            $post->images()->save($image);
            $post->save();
        }
        return response()->json($data);
    }
    public function edit(Post $post)
    {
        $category = Category::all();
        $tags = Tag::all();
        return view('admin_dashboard.posts.edit',[
            'post' => $post,
            'categories' => $category,
            'tags' => $tags
        ]);
    }
    public function update(Post $post)
    {
        $data = array();
        $data['error'] = [];
        $data['success'] = 0;
        $rules = [
            'tittle' => 'required|min:3|max:255',
            'body' => 'required|min:3',
            'excerpt' =>'required',
            'category_id' => 'required',
            'slug' => 'required|unique:posts,slug,'.$post->id,
            'tags' => 'required',
            'public' => 'required',
            'post_thumb' => 'required',
        ];
        // dd(request()->all());
        $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {
            $data['error']['tittle'] = $validate->errors()->first('tittle');
            $data['error']['body'] = $validate->errors()->first('body');
            $data['error']['excerpt'] = $validate->errors()->first('excerpt');
            $data['error']['category_id'] = $validate->errors()->first('category_id');
            $data['error']['tags'] = $validate->errors()->first('tags');
            $data['error']['public'] = $validate->errors()->first('public');
            $data['error']['post_thumb'] = $validate->errors()->first('post_thumb');
            $data['message'] = 'Please check the form again';
        } else {
            $attribute = $validate->validated();
            $attribute['user_id'] = auth()->user()->id;
            // dd($attribute);
            $data['success'] = 1;
            $data['message'] = 'Update post successfully';
            $post->tittle = $attribute['tittle'];
            $post->body = $attribute['body'];
            $post->excerpt = $attribute['excerpt'];
            $post->category_id = $attribute['category_id'];
            $post->slug = $attribute['slug'];
            $post->public = $attribute['public'];
            $post->tags()->sync(explode(',',$attribute['tags']));
            if($attribute['post_thumb'][0] == '/'){
                $image = Image::where('path',substr($attribute['post_thumb'],1))->first();
            }else{
                $image = Image::where('path',$attribute['post_thumb'])->first();
            }
            $post->images()->save($image);
            $post->save();
        }
        return response()->json($data);
    }
    public function destroy($id)
    {
        //
    }
}
