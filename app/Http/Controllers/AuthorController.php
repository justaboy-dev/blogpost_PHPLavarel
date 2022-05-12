<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;


class AuthorController extends Controller
{
    public function show(User $author)
    {
        $posts = Post::where('user_id',$author->id)->orderBy('created_at', 'desc')->paginate(15);
        $popular_post = Post::withCount('comments') ->orderBy('comments_count', 'desc')->take(5)->get();
        $categories = Category::withCount('posts')->orderBy('posts_count','DESC')->take(10)->get();
        $tags = Tag::withCount('posts')->get();
        return view('author.show',[
            'posts' => $posts,
            'popular_post' => $popular_post,
            'categories' => $categories,
            'tags' => $tags,
            'author' => $author,
        ]);
    }
}
