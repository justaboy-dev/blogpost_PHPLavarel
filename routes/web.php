<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Models\Post;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/posts/{post:slug}', [PostController::class,'show'])->name('posts.show');
Route::post('/post/{post:slug}', [PostController::class,'add_comment'])->name('posts.add_comment');
Route::get('/about', AboutController::class)->name('about');

Route::get('/contact', [ContactController::class,'create'])->name('contact.create');

Route::post('/contact', [ContactController::class,'store'])->name('contact.store');

Route::get('/category/{category:slug}', [CategoryController::class,'show'])->name('category.show');



require __DIR__.'/auth.php';
