<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('upload-image', [ProfileController::class, 'index']);
// Route::post('save', [ProfileController::class, 'save'])->name('save');


Route::resource('contact','ContactController')->middleware('auth');
Route::resource('edit','ContactController')->middleware('auth');
Route::resource('todolist','TodoListController')->middleware('auth');
Route::resource('profile','ProfileController')->middleware('auth');
Route::resource('friendlist','FriendListController')->middleware('auth');
Route::resource('post','PostController')->middleware('auth');
Route::resource('newfeed','NewsFeedsController')->middleware('auth');

Route::get('/post/create', 'PostController@create')->name('post.create');
Route::post('/post/store', 'PostController@store')->name('post.store');

Route::get('/posts', 'PostController@index')->name('posts');
// Route::get('/post/show/{id}', 'PostController@show')->name('post.show');

Route::get('/post/update', 'PostController@update')->name('post.update');

Route::post('/comment/store', 'CommentController@store')->name('comment.add');
Route::post('/reply/store', 'CommentController@replyStore')->name('reply.add');


