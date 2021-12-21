<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

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

Route::get('/', 'App\Http\Controllers\BlogController@showList')->name('blogs');
Route::get('/blog/show/{id}', 'App\Http\Controllers\BlogController@showDetail')->name('show');
Route::get('/blog/edit/{id}', 'App\Http\Controllers\BlogController@showEdit')->name('edit');
Route::post('/blog/delete/{id}', 'App\Http\Controllers\BlogController@delete')->name('delete');
Route::get('/blog/exesearch', 'App\Http\Controllers\BlogController@exeSearch')->name('exesearch');
Route::post('/blog/exesearch', 'App\Http\Controllers\BlogController@exeSearch')->name('exesearch');
Route::get('/blog/create', 'App\Http\Controllers\BlogController@showCreate')->name('create');
Route::get('/blog/search', 'App\Http\Controllers\BlogController@showSearch')->name('search');
Route::post('/blog/store', 'App\Http\Controllers\BlogController@exeStore')->name('store');
Route::post('/blog/update', 'App\Http\Controllers\BlogController@exeupdate')->name('update');

// Auth::routes();
