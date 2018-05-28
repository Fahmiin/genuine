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

Route::view('/', 'landing_page');
Route::get('/home', 'MainController@showPosts')->name('showPosts');

Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/profile', 'ProfileController@show')->name('profilePage');
Route::get('/profile/{id}', 'ProfileController@showLoggedout')->name('profilePageLoggedout');
Route::post('/profile/pic/{id}', 'ProfileController@updateProfilepic')->name('profilePic');
Route::post('/profile/update/{id}', 'ProfileController@updateProfile')->name('updateProfile');

Route::post('/profile/details/about/{id}', 'ProfileController@updateAbout')->name('detailsUpdateAbout');
Route::post('/profile/details/education/{id}', 'ProfileController@updateEducation')->name('detailsUpdateEducation');
Route::post('/profile/details/work/{id}', 'ProfileController@updateWork')->name('detailsUpdateWork');

Route::post('/profile/products', 'ProfileController@createProduct')->name('createProduct');
Route::delete('/profile/product/{id}', 'ProfileController@deleteProduct')->name('deleteProduct');

Route::post('/post', 'PostController@createPost')->name('createPost');
Route::post('/post/edit/{id}', 'PostController@editPost')->name('editPost');
Route::delete('/post/{id}', 'PostController@deletePost')->name('deletePost');
Route::post('/like', 'PostController@createLike')->name('createLike');

Route::get('/search', 'MainController@showPosts')->name('showPosts');
Route::get('/search/users', 'SearchController@liveSearch')->name('liveSearch');

Route::post('/comment/{id}', 'CommentController@createComment')->name('createComment');
Route::delete('/comment/{id}', 'CommentController@deleteComment')->name('deleteComment');

Route::get('/tags', 'TagController@showTags')->name('showTags');
Route::get('/search/tags', 'TagController@searchTags')->name('searchTags');
Route::get('/tag/{id}', 'TagController@showTag')->name('showTag');
Route::post('/tags/create', 'TagController@createTag')->name('createTag');

Route::post('/review/{id}', 'ReviewController@createReview')->name('createReview');
Route::delete('/review/delete/{id}', 'ReviewController@deleteReview')->name('deleteReview');

Route::post('/reply/{id}', 'ReplyController@createReply')->name('createReply');
Route::delete('/reply/delete/{id}', 'ReplyController@deleteReply')->name('deleteReply');

Route::post('/favourite', 'BookmarkController@createFavourite')->name('createFav');
Route::get('/contacts', 'BookmarkController@showContacts')->name('showContacts');
Route::get('/quickview', 'BookmarkController@quickView')->name('quickView');