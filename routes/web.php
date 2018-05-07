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

Route::view('/', 'main');

Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/profile', 'ProfileController@show')->name('profilePage');
Route::post('/profile/pic/{id}', 'ProfileController@updateProfilepic')->name('profilePic');
Route::post('/profile/update/{id}', 'ProfileController@update')->name('update');

Route::post('/profile/details/about/{id}', 'DetailController@updateAbout')->name('detailsUpdateAbout');
Route::post('/profile/details/education/{id}', 'DetailController@updateEducation')->name('detailsUpdateEducation');
Route::post('/profile/details/work/{id}', 'DetailController@updateWork')->name('detailsUpdateWork');

Route::post('/profile/products', 'ProductController@createProduct')->name('createProduct');
Route::get('/profile/products', 'ProductController@showProducts')->name('showProducts');
Route::delete('/profile/product/{id}', 'ProductController@deleteProduct')->name('deleteProduct');

Route::post('/profile/post', 'PostController@createPost')->name('createPost');
Route::get('/profile/post', 'PostController@showPosts')->name('showPosts');