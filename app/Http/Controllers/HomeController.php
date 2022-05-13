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
        $posts = Post::where('public',true)->orderBy('created_at', 'desc')->paginate(15);
        $popular_post = Post::where('public',true)->orderBy('views', 'desc')->take(5)->get();
        $categories = Category::withCount('posts')->orderBy('posts_count','DESC')->take(10)->get();
        $tags = Tag::withCount('posts')->get();
        return view('home',[
        'posts' => $posts,
        'popular_post' => $popular_post,
        'categories' => $categories,
        'tags' => $tags]);
    }
}
