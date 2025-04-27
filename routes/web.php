<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/greeting', function () {
    return 'Hello World';
});

Route::get('/parameters/{id}', function (string $id) {
    return 'User '.$id;
});

Route::resource('users', UserController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('posts', PostController::class);

Route::resource('notes', NoteController::class);

Route::resource('products', ProductController::class);

Route::resource('comments', CommentController::class);

