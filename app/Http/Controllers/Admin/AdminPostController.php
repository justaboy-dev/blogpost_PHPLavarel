<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;

class AdminPostController extends Controller
{
    public function index()
    {

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
            $data['success'] = 1;
            $data['message'] = 'Thank you for contacting us. We will get back to you as soon as possible.';
        }
        return response()->json($data);
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
}
