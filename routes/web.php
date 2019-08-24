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


Auth::routes();

Route::any('/send', 'MessageController@Send')->name('message.send');
Route::any('/send/store', 'MessageController@Store')->name('message.send.store');

Route::any('/receive', 'MessageController@Receive')->name('message.receive');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/1', function () {    Amqp::publish('routing-key', 'messsssage' , ['queue' => 'queue-name']); });
Route::get('/2', function () {
    Amqp::consume('queue-name', function ($message, $resolver) {
    		
        var_dump($message->body);
     
        $resolver->acknowledge($message);
     
        $resolver->stopWhenProcessed();
             
     });

});


