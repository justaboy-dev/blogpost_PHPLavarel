<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Models\Comment;
use DB;

class AdminCommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return view('admin.comment.index', compact('comments'));
    }
    public function create()
    {
        $posts = Post::all();
        return view('admin.comment.create', compact('posts'));
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        $data = array();
        $data['error'] = [];
        $data['success'] = 0;
        $rule = [
            'post_id' => 'required',
            'the_comment' => 'required|min:3|max:255',
        ];
        $validate = Validator::make($request->all(), $rule);
        if($validate->fails()){
            $data['error'][] = $validate->errors()->first('post_id');
            $data['error'][] = $validate->errors()->first('the_comment');
            $data['message'] = 'Please check your input';
            DB::rollback();
        }
        else{
            $attribute = $validate->validated();
            $attribute['user_id'] = auth()->user()->id;
            $post = Post::find($attribute->post_id);
            $post->comments()->create($attribute);
            $data['success'] = 1;
            $data['message'] = 'Comment has been added';
            DB::commit();
        }
        return response()->json($data);
    }
    public function show($id)
    {
        //
    }
    public function edit(Comment $comment)
    {
        $posts = Post::all();
        return view('admin.comment.edit', compact('comment', 'posts'));
    }
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $data = array();
        $data['error'] = [];
        $data['success'] = 0;
        $rule = [
            'post_id' => 'required',
            'the_comment' => 'required|min:3|max:255',
        ];
        $validate = Validator::make($request->all(), $rule);
        if($validate->fails()){
            $data['error'][] = $validate->errors()->first('post_id');
            $data['error'][] = $validate->errors()->first('the_comment');
            $data['message'] = 'Please check your input';
            DB::rollback();
        }
        else{
            $attribute = $validate->validated();
            $comment = Comment::find($id);
            $comment->update($attribute);
            $data['success'] = 1;
            $data['message'] = 'Comment has been updated';
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
        $comment = Comment::find($id);
        if($comment){
            $comment->delete();
            $data['success'] = 1;
            $data['message'] = 'Comment has been deleted';
            DB::commit();
        }
        else{
            $data['error'][] = 'Comment not found';
            $data['message'] = 'Please check your input';
            DB::rollback();
        }
        return response()->json($data);
    }
}
