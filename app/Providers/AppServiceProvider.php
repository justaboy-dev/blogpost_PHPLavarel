<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Contact;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    public function boot()
    {
        Paginator::useBootstrap();
        $categories = Category::withCount('posts')->orderBy('posts_count','DESC')->take(10)->get();
        $settings = Setting::all();
        $user_count = \App\Models\User::count();
        $contact = Contact::all();


        View::share('navbar_category', $categories);
        View::share('settings', $settings);
        View::share('user_count', $user_count);
        View::share('contact', $contact);
    }
}
