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
    $users = \App\User::count();
    Debugbar::info($users);
    return view('welcome');
});


//Auth::routes();
Auth::routes([ 'register' => false ]);

if (\App\User::count()<=0) {
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
}


Route::get('/home', 'HomeController@index')->name('home');
