<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(15);
        $popular_post = Post::withCount('comments') ->orderBy('comments_count', 'desc')->take(5)->get();
        $categories = Category::withCount('posts')->take(10)->get();
        $tags = Tag::withCount('posts')->get();
        return view('home',[
        'posts' => $posts,
        'popular_post' => $popular_post,
        'categories' => $categories,
        'tags' => $tags]);
    }
}
