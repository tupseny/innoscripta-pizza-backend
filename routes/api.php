<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'LoginController@authenticate');
Route::post('logout', 'LoginController@logout');

Route::apiResource('register', 'RegisterController', [
   'only' => ['store']
]);

Route::apiResource('/menu', 'MenuGroupController')->except([
    'store', 'update', 'destroy'
]);

Route::middleware('auth:api')->post('/order', 'OrderController@store');
Route::post('/order/anon', 'OrderController@storeAnon');
