<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use App\Models\Image;
use DB;


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
        DB::beginTransaction();
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
            $data['error'][] = $validate->errors()->first('tittle');
            $data['error'][] = $validate->errors()->first('body');
            $data['error'][] = $validate->errors()->first('excerpt');
            $data['error'][] = $validate->errors()->first('category_id');
            $data['error'][] = $validate->errors()->first('tags');
            $data['error'][] = $validate->errors()->first('public');
            $data['error'][] = $validate->errors()->first('post_thumb');
            $data['message'] = 'Please check the form again';
            DB::rollback();
        } else {
            $attribute = $validate->validated();
            $attribute['user_id'] = auth()->user()->id;
            // dd($attribute);
            $data['success'] = 1;
            $data['message'] = 'Create post successfully';
            $post = Post::create($attribute);
            $post->tags()->sync(explode(',',$attribute['tags']));
            if($attribute['post_thumb'][0] == '/'){
                $image = Image::where('path',substr($attribute['post_thumb'],1))->first();
            }else{
                $image = Image::where('path',$attribute['post_thumb'])->first();
            }
            $post->images()->save($image);
            $post->save();
            DB::commit();
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
        DB::beginTransaction();
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
            $data['error'][] = $validate->errors()->first('tittle');
            $data['error'][] = $validate->errors()->first('body');
            $data['error'][]= $validate->errors()->first('excerpt');
            $data['error'][] = $validate->errors()->first('category_id');
            $data['error'][] = $validate->errors()->first('tags');
            $data['error'][] = $validate->errors()->first('public');
            $data['error'][] = $validate->errors()->first('post_thumb');
            $data['message'] = 'Please check the form again';
            DB::rollback();
        } else {
            $attribute = $validate->validated();
            $attribute['user_id'] = auth()->user()->id;
            // dd($attribute);
            $data['success'] = 1;
            $data['message'] = 'Update post successfully';
            $post->update($attribute);
            $post->public = $attribute['public'];
            $post->tags()->sync(explode(',',$attribute['tags']));
            if($attribute['post_thumb'][0] == '/'){
                $image = Image::where('path',substr($attribute['post_thumb'],1))->first();
            }else{
                $image = Image::where('path',$attribute['post_thumb'])->first();
            }
            $post->images()->save($image);
            $post->save();
            DB::commit();
        }
        return response()->json($data);
    }
    public function destroy(int $id)
    {
        DB::beginTransaction();
        $data = array();
        $post = Post::find($id)->delete();
        if ($post) {
            $data['message'] = 'Delete post successfully';
            $data['success'] = 1;
            DB::commit();
        }
        else
        {
            $data['message'] = 'Delete post failed';
            $data['success'] = 0;
            DB::rollback();
        }
        return response()->json($data);
    }
}
