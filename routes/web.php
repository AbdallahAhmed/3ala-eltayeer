<?php

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

Route::get('/', ['uses' => "HomeController@index"])->name('index');
Route::get('/posts/{slug}', ['uses' => "PostController@show"])->name('posts.show');
Route::get('/page/{slug}', ['uses' => 'PageController@show'])->name('pages.show');
Route::get('/search/{q?}', ['uses' => 'HomeController@search'])->name('search');
Route::post('/subscribe', ['uses' => 'HomeController@subscribe'])->name('subscribe');
Route::get('/category/{slug}', ['uses' => 'CategoryController@index'])->name('category');
Route::get('/contact-us', ['uses' => 'ContactController@show'])->name('contact');
Route::post('/contact-us', ['uses' => 'ContactController@send'])->name('contact-us');
