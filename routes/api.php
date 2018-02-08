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

Route::group(['prefix' => 'v1'], function () {
//    Route::get('person/{response_type?}', '\App\Api\V1\Person\Controllers\PersonController@index');
    Route::resource('person', '\App\Api\V1\Person\Controllers\PersonController',
        [
            'only' => [
                'index',
                'show',
                'store',
                'update',
                'destroy'
            ]
        ]);
});

