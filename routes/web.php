<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('home');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


Route::get('/' , 'BlogController@index');

Route::get('/blog/{slug}' , 'BlogController@blogSingle');
Route::get('/category/{categoryName}/{slug}' , 'BlogController@categoryIndex');
Route::get('/tag/{tagName}/{id}' , 'BlogController@tagIndex');
Route::get('/blogs' , 'BlogController@allBlogs');
Route::get('/search' , 'BlogController@search');
