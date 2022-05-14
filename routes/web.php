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
    Route::get('/', [DashboardController::class, 'index'])->name('admin_dashboard.index');
    Route::get('/post', [AdminPostController::class, 'index'])->name('admin_dashboard.post.index');
    Route::get('/post/create', [AdminPostController::class, 'create'])->name('admin_dashboard.post.create');
    Route::post('/post/store', [AdminPostController::class, 'store'])->name('admin_dashboard.post.store');
    Route::get('/post/edit/{post:slug}', [AdminPostController::class, 'edit'])->name('admin_dashboard.post.edit');
    Route::post('/post/update/{post:id}', [AdminPostController::class, 'update'])->name('admin_dashboard.post.update');
    Route::delete('/post/destroy/{id}', [AdminPostController::class, 'destroy'])->name('admin_dashboard.post.destroy');

    Route::get('/category', [AdminCategoryController::class, 'index'])->name('admin_dashboard.category.index');
    Route::get('/category/create', [AdminCategoryController::class, 'create'])->name('admin_dashboard.category.create');
    Route::post('/category/store', [AdminCategoryController::class, 'store'])->name('admin_dashboard.category.store');
    Route::get('/category/edit/{category:slug}', [AdminCategoryController::class, 'edit'])->name('admin_dashboard.category.edit');
    Route::post('/category/update/{category:id}', [AdminCategoryController::class, 'update'])->name('admin_dashboard.category.update');
    Route::delete('/category/destroy/{id}', [AdminCategoryController::class, 'destroy'])->name('admin_dashboard.category.destroy');
});


require __DIR__.'/auth.php';
