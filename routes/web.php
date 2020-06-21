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

use Illuminate\Support\Facades\View;

Route::get('/', 'HomeController@index')->name('home');


Auth::routes();
//subscriber
Route::post('/subscriber/store', 'SubscriberController@store')->name('subscriber.store');
//Favourite post
Route::group(['middleware'=>'auth'],function (){
    Route::post('favourite/post/{id}','FavouriteController@add')->name('favourite.post');
    Route::post('comment/{post}','CommentController@store')->name('comment.store');
});
//post-details
Route::get('post-details/{slug}','PostDetailsController@details')->name('post.details');
//all post
Route::get('posts','PostController@index')->name('all.post');
//post by category
Route::get('category/{slug}','PostController@posyByCategory')->name('category.post');
//post by tag
Route::get('tag/{slug}','PostController@posyByTag')->name('tag.post');
//search
Route::get('search','SearchController@search')->name('search');
//author
Route::get('profile/{username}','AuthorController@author')->name('author.profile.post');




Route::group(['prefix'=>'admin', 'namespace' => 'Admin', 'middleware'=>['auth','admin']],function (){
   Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');

   //tag
    Route::get('/tag', 'TagController@index')->name('admin.tag');
    Route::get('/tag/create', 'TagController@create')->name('admin.tag.create');
    Route::post('/tag/store', 'TagController@store')->name('admin.tag.store');
    Route::get('/tag/edit/{id}', 'TagController@edit')->name('admin.tag.edit');
    Route::put('/tag/update/{id}', 'TagController@update')->name('admin.tag.update');
    Route::delete('/tag/destroy/{id}', 'TagController@destroy')->name('admin.tag.destroy');

    //category
    Route::get('/category', 'CategoryController@index')->name('admin.category');
    Route::get('/category/create', 'CategoryController@create')->name('admin.category.create');
    Route::post('/category/store', 'CategoryController@store')->name('admin.category.store');
    Route::get('/category/edit/{id}', 'CategoryController@edit')->name('admin.category.edit');
    Route::put('/category/update/{id}', 'CategoryController@update')->name('admin.category.update');
    Route::delete('/category/destroy/{id}', 'CategoryController@destroy')->name('admin.category.destroy');

    //post
    Route::get('/post', 'PostController@index')->name('admin.post');
    Route::get('/post/create', 'PostController@create')->name('admin.post.create');
    Route::post('/post/store', 'PostController@store')->name('admin.post.store');
    Route::get('/post/edit/{id}', 'PostController@edit')->name('admin.post.edit');
    Route::put('/post/update/{id}', 'PostController@update')->name('admin.post.update');
    Route::delete('/post/destroy/{id}', 'PostController@destroy')->name('admin.post.destroy');
    Route::get('/post/show/{id}','PostController@show')->name('admin.post.show');

    Route::get('/post/publish/{id}','PostController@publish')->name('admin.post.publish');
    Route::get('/post/pending/{id}','PostController@pending')->name('admin.post.pending');

    Route::get('/approval/post', 'PostController@approval')->name('admin.post.approval');
    Route::put('/approval-post/{id}', 'PostController@approval_post')->name('admin.post.approval-post');

    //subscriber
    Route::get('/subscriber', 'SubscriberController@index')->name('admin.subscriber');
    Route::delete('/subscriber/destroy/{id}', 'SubscriberController@destroy')->name('admin.subscriber.destroy');

    //profile
    Route::get('/profile','ProfileController@index')->name('admin.profile');
    Route::put('/profile-update','ProfileController@update')->name('admin.profile.update');
    Route::put('/password-update','ProfileController@password_update')->name('admin.password.update');

    //favourite Post
    Route::get('/favourite-post','FavouriteController@index')->name('admin.favourite-post');

    //comment
    Route::get('/comment','CommentController@index')->name('admin.comment');
    Route::delete('/comment/destroy/{id}','CommentController@destroy')->name('admin.comment.destroy');

    //author
    Route::get('/author','AuthorController@index')->name('admin.author');
    Route::delete('/author/destroy/{id}','AuthorController@destroy')->name('admin.author.destroy');




});

Route::group(['prefix'=>'author', 'namespace' => 'Author', 'middleware'=>['auth','author']],function (){
    Route::get('/dashboard', 'DashboardController@index')->name('author.dashboard');

    //post
    Route::get('/post', 'PostController@index')->name('author.post');
    Route::get('/post/create', 'PostController@create')->name('author.post.create');
    Route::post('/post/store', 'PostController@store')->name('author.post.store');
    Route::get('/post/edit/{id}', 'PostController@edit')->name('author.post.edit');
    Route::put('/post/update/{id}', 'PostController@update')->name('author.post.update');
    Route::delete('/post/destroy/{id}', 'PostController@destroy')->name('author.post.destroy');
    Route::get('/post/show/{id}','PostController@show')->name('author.post.show');

    Route::get('/post/publish/{id}','PostController@publish')->name('author.post.publish');
    Route::get('/post/pending/{id}','PostController@pending')->name('author.post.pending');

    //profile
    Route::get('/profile','ProfileController@index')->name('author.profile');
    Route::put('/profile-update','ProfileController@update')->name('author.profile.update');
    Route::put('/password-update','ProfileController@password_update')->name('author.password.update');

    //favourite Post
    Route::get('/favourite-post','FavouriteController@index')->name('author.favourite-post');

    //comment
    Route::get('/comment','CommentController@index')->name('author.comment');
    Route::delete('/comment/destroy/{id}','CommentController@destroy')->name('author.comment.destroy');


});

// Using Closure based composers...
View::composer('layouts.frontend.footer', function ($view) {
    $categories = App\Category::all();
    $view->with('categories', $categories);
});