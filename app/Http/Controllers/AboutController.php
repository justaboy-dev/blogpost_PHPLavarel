<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\User;
use App\Models\Post;

class AboutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $settings = Setting::all();
        $post_count = Post::count();
        $user_count = User::count();
        $post_views = Post::sum('views');
        return view('about', compact('settings','post_count','post_views','user_count'));
    }
}
