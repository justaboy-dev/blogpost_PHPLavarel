<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use DB;

class AdminTagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('admin_dashboard.tag.index', compact('tags'));
    }
    public function show($id)
    {
        $posts = Tag::find($id)->posts;
        return view('admin_dashboard.posts.index', compact('posts'));
    }
    public function edit(Tag $tag)
    {
        return view('admin_dashboard.tag.edit', compact('tag'));
    }
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $data = array();
        $data['error'] = [];
        $data['success'] = 0;
        $rules = [
            'name' => 'required|min:3|max:255',
        ];
        $validate = Validator::make($request->all(), $rules);
        if($validate->fails())
        {
            $data['error'][] = $validate->errors()->first('name');
            $data['message'] = 'Please check the form again';
            DB::rollback();
        }
        else
        {
            $attribute = $validate->validated();
            $tag = Tag::find($id);
            $tag->update($attribute);
            $data['success'] = 1;
            $data['message'] = 'Tag updated successfully';
            DB::commit();
        }
        return response()->json($data);
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        $data = array();
        $data['error'] = [];
        $data['success'] = 0;
        $tag = Tag::find($id);
        if($tag)
        {
            $tag->posts()->detach();
            $tag->delete();
            $data['success'] = 1;
            $data['message'] = 'Tag deleted successfully';
            DB::commit();
        }
        else
        {
            $data['error'][] = 'Tag not found';
            $data['message'] = 'Tag not found';
            DB::rollback();
        }
        return response()->json($data);
    }
}
