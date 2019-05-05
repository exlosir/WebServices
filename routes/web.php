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
   return redirect('/');
})->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix'=>'admin', 'middleware'=>['auth', 'admin']], function() {
    Route::get('/', 'AdminController@index')->name('admin');

    /*Маршруты для стран*/
    Route::resource('/country', 'CountryController');
    /*Маршруты для городов*/
    Route::resource('/city', 'CityController');
    /*Маршруты для категорий*/
    Route::resource('/category', 'CategoryController');
});


Route::group(['prefix'=>'profile', 'middleware'=>['auth']], function(){
    /*Профиль*/
    Route::get('/', 'ProfileController@index')->name('profile');
    Route::post('/save', 'ProfileController@save')->name('profile_save');
    Route::post('/upload-profile-image', 'ProfileController@uploadImage')->name('upload-profile-image');
    Route::post('/add-role', 'ProfileController@addRole')->name('add-role-user');
    Route::post('/del-role', 'ProfileController@delRole')->name('del-role-user');
    Route::get('/get-role', 'ProfileController@getRole')->name('get-role-user');

    /*Изменение пароля*/
    Route::post('/change-password', 'ProfileController@changePassword')->name('change-password');

    /*Порфтолио*/
    Route::group(['prefix'=>'portfolio'],function(){
        Route::get('/','PortfolioController@index')->name('portfolio');
        Route::post('/new', 'PortfolioController@newElement')->name('add-new-element-portfolio');
        Route::delete('/delete/{id}', 'PortfolioController@deleteElement')->name('delete-elem-portfolio');
    });

    /*Подтверждение E-mail*/

    Route::get('/request-confirmation-email', "ConfirmationEmailController@request")->name('request-confirmation-email')->middleware('checkUserConfirmedEmail');
    Route::post('/send-confirmation-email', "ConfirmationEmailController@sendEmail")->name('send-confirmation-email');
    Route::get('/confirm-email/{user}/{token}', "ConfirmationEmailController@confirm")->name('confirm-email')->middleware(['except'=>'auth']);

    /*Удаление аккаунта*/
    Route::delete('/delete-account', 'ProfileController@deleteAccount')->name('delete-account');
});

/*Отображение страниц пользователя и все что с ними связано*/

Route::group(['prefix'=>'user', 'middleware'=>['auth']],function(){
    Route::get('/{id}', 'UserController@user')->name('user-page');
    Route::get('/{id}/portfolio', 'UserController@extendUserPortfolio')->name('extend-user-portfolio');
});

Route::group(['prefix'=>'orders', 'middleware'=>['auth']], function(){
    Route::get('/{category?}', 'OrderController@index')->name('orders');
    Route::get('/new/add', 'OrderController@add')->name('add-order');
    Route::post('/add/save', 'OrderController@save')->name('save-order');
    Route::get('/{id}/more','OrderController@indexMore')->name('order-more');
    Route::delete('/{order}/delete','OrderController@destroyOrder')->name('destroy-order');
    Route::post('/{order}/close', 'OrderController@closeOrder')->name('close-order');

    /*Отызывы*/
    Route::post('/{order}/feedback/create', 'FeedbackController@create')->name('feedback-create');
    Route::post('/{order}/feedback/store', 'FeedbackController@store')->name('feedback-store');


    Route::group(['prefix'=>'order-master'], function() {
        Route::post('{orderid}/add/{userid}', 'OrderUserController@add')->name('add-user-order');
        Route::post('{order}/accept-master/{master}', 'OrderUserController@acceptMaster')->name('accept-master-order');
        Route::get('/get-users', 'OrderUserController@getUsers')->name('get-users-order');
    });
});