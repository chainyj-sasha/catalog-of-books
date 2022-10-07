<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;

/* section */
Route::get('/', [SectionController::class, 'show_all_section'])->name('show_all_section');

/* author */
Route::get('/author/{sectionId}', [AuthorController::class, 'show_all_authors'])->name('show_all_authors');

/* book */
Route::group(['prefix' => 'books'], function(){
    Route::get('/author/{authorId}', [BookController::class, 'show_all_books'])->name('show_all_books');
    Route::post('/find', [BookController::class, 'find_books'])->name('find_books');
    Route::resource('books', BookController::class);
});

/* user */
Route::group(['prefix' => 'users'], function(){
    Route::post('/login', [UserController::class, 'login'])->name('login');
    Route::get('/logout', [UserController::class, 'logout'])->middleware('auth')->name('logout');
    Route::resource('/users', UserController::class);
});

/* admin */
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function(){
    Route::resource('/sections', \App\Http\Controllers\admin\SectionController::class);
    Route::resource('/authors', \App\Http\Controllers\admin\AuthorController::class);
});
