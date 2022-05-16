<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Models\Post;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminTagController;
use App\Http\Controllers\Admin\AdminCommentController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('post_views')->group(function(){
    Route::get('/posts/{post:slug}', [PostController::class,'show'])->name('posts.show');
});

Route::post('/post/{post:slug}', [PostController::class,'add_comment'])->name('posts.add_comment');

Route::get('/about', AboutController::class)->name('about');


Route::get('/contact', [ContactController::class,'create'])->name('contact.create');
Route::post('/contact', [ContactController::class,'store'])->name('contact.store');

Route::get('/category/{category:slug}', [CategoryController::class,'show'])->name('category.show');
Route::get('/category', [CategoryController::class,'index'])->name('category.index');

Route::get('/tag/{tag:name}', [TagController::class,'show'])->name('tag.show');


Route::get('/author/{author:name}',[AuthorController::class,'show'])->name('author.show');

//admin
Route::prefix('admin')->name('admin.')->middleware(['auth','isadmin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::resource('post',AdminPostController::class)->except(['show']);
    Route::resource('category',AdminCategoryController::class);
    Route::resource('user',AdminUserController::class);
    Route::resource('tag',AdminTagController::class)->except(['create','store']);
    Route::resource('comment', AdminCommentController::class);
});


require __DIR__.'/auth.php';
