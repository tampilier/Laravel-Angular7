<?php

use Illuminate\Http\Request;

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

// App v1 API
/*Route::group([
    'middleware' => ['app', 'api.version:1'],
    'namespace'  => 'App\Http\Controllers\App',
    'prefix'     => 'api/v1',
], function ($router) {
    require base_path($router);
});*/

Route::resource('rest', 'RestTestController')->names('restTest');

Route::group(['prefix' => 'v1'], function(){

    //user
    Route::post('users/login', 'UserController@login');
    Route::get('users/logout', 'UserController@logout');
    Route::get('users/me', 'UserController@me');

    //products
    Route::get('products', 'ProductController@index');
    Route::post('products', 'ProductController@create');
    Route::put('products/{id}', 'ProductController@update');
    Route::get('products/{id}', 'ProductController@show');

    Route::options('', 'UserController@other');
    Route::options('{all}', 'UserController@other');
});

