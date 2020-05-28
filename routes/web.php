<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home');
Auth::routes();
Route::get('/order/historique', 'OrderController@history');
Route::get('/order/commande/historique', 'OrderController@historyv');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/order/commande', 'OrderController@reshow')->name('order.reshow');
Route::get('/profile/{user}', 'ProfileController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfileController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfileController@update')->name('profile.update');
Route::get('/post/create', 'PostController@create')->name('post.create');
Route::get('/item/create', 'ItemController@create')->name('item.create');
Route::post('/item/create', 'ItemController@create');
Route::post('/item', 'ItemController@store')->name('item.store');
Route::post('/items', 'ItemController@restore');
Route::get('/post/{post}', 'PostController@show')->name('post.show');
Route::get('/categorie/{categorie}', 'CategorieController@show')->name('categorie.show');
Route::get('/ville/{villes}', 'HomeController@showville');
Route::post('/search', 'HomeController@search');
Route::delete('/post/{post}', 'PostController@destroy')->name('post.destroy');
Route::post('/comments/{post_id}/{order_id}','CommentController@store')->name('comments.store');
Route::get('/comments/{post_id}/{order_id}','CommentController@show')->name('comments.show');
Route::get('/order/{post}', 'OrderController@create')->name('order.create');
Route::post('/order', 'OrderController@store')->name('order.store');
Route::post('/commande/comments/{user_id}/{orders_id}','CommentUserController@store');
Route::get('/commande/comments/{user_id}/{orders_id}','CommentUserController@show');
Route::get('/order', 'OrderController@show')->name('order.show');
Route::get('/order/{id}/accepted', 'OrderController@update')->name('order.update');
Route::get('/order/{id}/refused', 'OrderController@destroy')->name('order.destroy');
Route::get('/order/{id}/payed', 'OrderController@reupdate');
Route::get('/order/historique', 'OrderController@history');
Route::get('/profile/{user_id}/comments','CommentUserController@index');






