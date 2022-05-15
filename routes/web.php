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
    Route::get('/post', [AdminPostController::class, 'index'])->name('post.index');
    Route::get('/post/create', [AdminPostController::class, 'create'])->name('post.create');
    Route::post('/post/store', [AdminPostController::class, 'store'])->name('post.store');
    Route::get('/post/edit/{post:slug}', [AdminPostController::class, 'edit'])->name('post.edit');
    Route::post('/post/update/{post:id}', [AdminPostController::class, 'update'])->name('post.update');
    Route::delete('/post/destroy/{id}', [AdminPostController::class, 'destroy'])->name('post.destroy');

    Route::get('/category', [AdminCategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [AdminCategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [AdminCategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{category:slug}', [AdminCategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update/{category:id}', [AdminCategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/destroy/{id}', [AdminCategoryController::class, 'destroy'])->name('category.destroy');

    Route::get('/user', [AdminUserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [AdminUserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [AdminUserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{user:id}', [AdminUserController::class, 'edit'])->name('user.edit');
    Route::post('/user/update/{user:id}', [AdminUserController::class, 'update'])->name('user.update');
    Route::delete('/user/destroy/{id}', [AdminUserController::class, 'destroy'])->name('user.destroy');
});


require __DIR__.'/auth.php';
