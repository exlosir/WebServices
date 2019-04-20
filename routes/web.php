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

Route::get('/logout', function () {
   auth()->logout();
   return redirect('/login');
})->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');



Route::group(['prefix'=>'profile', 'middleware'=>'auth'], function(){
    Route::get('/', 'ProfileController@index')->name('profile');
    Route::post('/save', 'ProfileController@save')->name('profile_save');
});
