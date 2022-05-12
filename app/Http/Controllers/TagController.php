<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;

class TagController extends Controller
{
    public function index()
    {
        return view('tag');
    }
    public function show(Tag $tag)
    {
        $popular_post = Post::where('public',true)->withCount('comments') ->orderBy('comments_count', 'desc')->take(5)->get();
        $categories = Category::withCount('posts')->orderBy('posts_count','DESC')->take(10)->get();
        $tags = Tag::withCount('posts')->get();
        return view('tag.show',[
            'posts' => $tag->posts()->paginate(15),
            'popular_post' => $popular_post,
            'categories' => $categories,
            'tags' => $tags,
            'tag' => $tag,
        ]);
    }
}
