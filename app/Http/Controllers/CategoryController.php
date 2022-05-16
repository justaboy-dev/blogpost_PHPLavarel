<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.index', [
            'categories' => Category::withCount('posts')->orderBy('posts_count','DESC')->paginate(12),
        ]);
    }
    public function show(Category $category)
    {
        $popular_post = Post::where('public',true)->orderBy('views', 'desc')->take(5)->get();
        $categories = Category::withCount('posts')->orderBy('posts_count','DESC')->take(10)->get();
        $tags = Tag::withCount('posts')->get();
        return view('category.show',[
            'category' => $category,
            'posts' => $category->posts()->where('public',true)->paginate(15),
            'popular_post' => $popular_post,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }
}
