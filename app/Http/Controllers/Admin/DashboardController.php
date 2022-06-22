<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $post_count = Post::count();
        $category_count = Category::count();
        $user_count = User::count();
        $total_post_view_count = Post::sum('views');

        $post_view_by_month = [];
        for ($i=1; $i<=12 ; $i++) {
            $post_view_by_month[] = Post::whereMonth('created_at', $i)->sum('views');
        }
        $category_post_count = [];
        foreach (Category::all() as $category) {
            $category_post_count['name'][] = $category->name;
            $category_post_count['post_count'][] = $category->posts->count();
        }
        return view('admin.index',compact('post_count','category_count','user_count','total_post_view_count','post_view_by_month','category_post_count'));
    }
}
