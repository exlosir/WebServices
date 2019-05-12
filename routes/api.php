<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('login', 'api\CountryController@country');
Route::post('register', 'api\auth\RegisterController@register');
Route::post('login', 'api\auth\AuthController@login');

Route::group(['middleware' => 'api'], function () {
    Route::get('test', function () {
        return response()->json('kek');
    });

    /*Заказы*/
    Route::group(['prefix'=>'orders'], function() {
        Route::get('/', 'api\OrdersController@allOrders');
        Route::post('/search', 'api\OrdersController@searchOrders');
        Route::get('/add', 'api\OrdersController@addOrder');
        Route::post('/add/new/store', 'api\OrdersController@storeOrder');
    });

});
