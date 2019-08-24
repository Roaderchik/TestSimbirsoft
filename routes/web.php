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

Route::get('/', function () {
    
    return view('index');
});


Auth::routes();

Route::any('/send', 'MessageController@Send')->name('message.send');
Route::any('/send/store', 'MessageController@Store')->name('message.send.store');

Route::any('/receive', 'MessageController@Receive')->name('message.receive');

Route::get('/home', 'HomeController@index')->name('home');