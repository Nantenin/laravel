<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/ 

Route::get('/',[SubjectController::class, 'index'])->name('index');

Route::get('showFromNotification/{subject}/{notification}', [SubjectController:: class, 'showFromNotification'])->name('subjects.showFromNotification');

Route::resource('subjects',SubjectController:: class)->except(['index']);

Route::post('/comments/{subject}', [CommentController:: class, 'store'])->name('comments.store');
Route::post('/commentReplay/{comment}', [CommentController:: class, 'storeCommentReplay'])->name('comments.storeReplay');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/markedAsSolution/{subject}/{comment}', [CommentController:: class, 'markedAsSolution'])->name('comments.markedAsSolution');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
