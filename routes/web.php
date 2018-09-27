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

Route::group(['prefix' => '/{lang?}', 'middleware' => ['localization']], function () {
    Route::get('/', ['uses' => "HomeController@index"])->name('index');
    Route::get('/posts/{slug}', ['uses' => "HomeController@show"])->name('posts.show');
    Route::get('/page/{slug}', ['uses' => 'PageController@show'])->name('pages.show');
    Route::get('/contact-us', function (){
       return view('contact-us');
    });
});
