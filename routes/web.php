<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/sections', 301);

use App\Http\Controllers\SectionController;
Route::resource('sections', SectionController::class);

use App\Http\Controllers\AuthorController;
Route::get('/authors/{sectionId}', [AuthorController::class, 'index'])->where('sectionId', '\d+')->name('authors.index');
Route::post('/authors/store', [AuthorController::class, 'store'])->name('authors.store');
Route::get('/authors/{id}/edit/', [AuthorController::class, 'edit'])->where('id', '\d+')->name('authors.edit');
Route::post('/authors/{id}', [AuthorController::class, 'update'])->where('id', '\d+')->name('authors.update');

use App\Http\Controllers\BookController;
Route::get('/books/{id}', [BookController::class, 'index'])->where('id', '\d+')->name('books.index');
Route::get('/books/showAll', [BookController::class, 'showAll'])->name('books.showAll');
Route::get('/books/{id}/show', [BookController::class, 'show'])->where('id', '\d+')->name('books.show');
Route::match(['get', 'post'],'/books/sort', [BookController::class, 'sort'])->name('books.sort');
Route::get('/books/find', [BookController::class, 'find'])->name('books.find');
Route::post('/books/store', [BookController::class, 'store'])->name('books.store');
Route::get('/books/{id}/edit/', [BookController::class, 'edit'])->where('id', '\d+')->name('books.edit');
Route::post('/books/{id}', [BookController::class, 'update'])->where('id', '\d+')->name('books.update');
Route::delete('/books/{id}', [BookController::class, 'destroy'])->where('id', '\d+')->name('books.destroy');

use App\Http\Controllers\UserController;
Route::get('users/register', [UserController::class, 'register'])->name('register');
Route::post('users/create', [UserController::class, 'create'])->name('users.create');
Route::get('users/login',[UserController::class, 'loginForm'])->name('login.form');
Route::post('users/login',[UserController::class, 'login'])->name('login');
Route::get('users/logout', [UserController::class, 'logout'])->name('users.logout');
