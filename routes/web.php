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

Route::get('/', 'MainController@showPosts')->name('showPosts');

Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/profile/{id}', 'ProfileController@show')->name('profilePage');
Route::post('/profile/pic/{id}', 'ProfileController@updateProfilepic')->name('profilePic');
Route::post('/profile/update/{id}', 'ProfileController@updateProfile')->name('updateProfile');

Route::post('/profile/details/about/{id}', 'ProfileController@updateAbout')->name('detailsUpdateAbout');
Route::post('/profile/details/education/{id}', 'ProfileController@updateEducation')->name('detailsUpdateEducation');
Route::post('/profile/details/work/{id}', 'ProfileController@updateWork')->name('detailsUpdateWork');

Route::post('/profile/products', 'ProfileController@createProduct')->name('createProduct');
Route::delete('/profile/product/{id}', 'ProfileController@deleteProduct')->name('deleteProduct');

Route::post('/profile/post', 'ProfileController@createPost')->name('createPost');
Route::delete('/profile/post/{id}', 'ProfileController@deletePost')->name('deletePost');