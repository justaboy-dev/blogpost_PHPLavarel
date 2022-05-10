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
        return view('category');
    }
    public function show(Category $category)
    {
        $popular_post = Post::withCount('comments') ->orderBy('comments_count', 'desc')->take(5)->get();
        $categories = Category::withCount('posts')->take(10)->get();
        $tags = Tag::withCount('posts')->get();
        return view('category.show',[
            'category' => $category,
            'posts' => $category->posts()->paginate(15),
            'popular_post' => $popular_post,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }
}
