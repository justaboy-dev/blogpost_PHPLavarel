<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Event;

class PostController extends Controller
{
    public function show($post)
    {
        $post = Post::where('slug', $post)->firstOrFail();
        Event::dispatch('post', $post);
        $same_author_posts = Post::where('user_id', $post->user_id)->where('public',true)->get();
        if (count($same_author_posts) < 1) {
            $same_author_posts = Post::where('public',true)->random(5);
        }
        return view('post', [
            'post' => $post,
            'same_author_posts' => $same_author_posts,
        ]);
    }
    public function add_comment(Post $post)
    {
        $attributes = request()->validate([
            'the_comment' => 'required|min:1|max:300',
        ]);
        $attributes['user_id'] = auth()->id();
        $comment = $post -> comments() -> create($attributes);
        return redirect('/posts/' . $post->slug . '#comments')->with('success', 'Comment added successfully');
    }
    public function search()
    {
        $search = request()->keyword;
        $posts = Post::where('tittle','like','%'.$search.'%')->paginate(10);
        $popular_post = Post::where('public',true)->orderBy('views', 'desc')->take(5)->get();
        $categories = Category::withCount('posts')->orderBy('posts_count','DESC')->take(10)->get();
        $tags = Tag::withCount('posts')->get();
        return view('home',compact('posts','popular_post','categories','tags'));
    }
}
