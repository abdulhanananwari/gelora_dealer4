<?php

$middleware = ['wala.jwt.header.parser', 'wala.jwt.header.validation', 'auth.db.overwrite', 'leasingPersonnelAccess'];

Route::group(['prefix' => 'leasing-app/api', 'namespace' => 'Api', 'middleware' => $middleware], function() {

    Route::group(['prefix' => 'leasing'], function() {
        Route::get('/', ['uses' => 'LeasingController@index']);
    });

    Route::group(['prefix' => 'leasing-order'], function() {
        Route::get('/', ['uses' => 'LeasingOrderController@index']);
        Route::get('{id}', ['uses' => 'LeasingOrderController@get']);

        Route::post('/', ['uses' => 'LeasingOrderController@store']);
        Route::post('{id}', ['uses' => 'LeasingOrderController@update']);
    });

    Route::group(['prefix' => 'leasing-personnel'], function() {
        Route::get('/', ['uses' => 'LeasingPersonnelController@index']);
        Route::get('{id}', ['uses' => 'LeasingPersonnelController@get']);

        Route::post('/', ['uses' => 'LeasingPersonnelController@store']);
        Route::post('{id}', ['uses' => 'LeasingPersonnelController@update']);

        Route::delete('{id}', ['uses' => 'LeasingPersonnelController@delete']);
    });
});
