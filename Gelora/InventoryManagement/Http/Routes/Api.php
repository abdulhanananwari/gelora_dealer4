<?php

$middleware = ['wala.jwt.header.parser', 'wala.jwt.header.validation',
    'auth.db.overwrite'];

Route::group(['prefix' => 'api', 'namespace' => 'Api', 'middleware' => $middleware], function() {

    Route::group(['prefix' => 'movement-order-header'], function() {
        Route::get('/', ['uses' => 'MovementOrderHeaderController@index']);
        Route::post('close/{id}', ['uses' => 'MovementOrderHeaderController@close']);
        Route::get('{id}', ['uses' => 'MovementOrderHeaderController@get']);
        Route::post('/', ['uses' => 'MovementOrderHeaderController@store']);
        Route::post('{id}/movement-details', ['uses' => 'MovementOrderHeaderController@addMovementOrderDetail']);
        Route::post('{id}', ['uses' => 'MovementOrderHeaderController@update']);
    });

    Route::group(['prefix' => 'movement-order-detail'], function() {
        Route::post('/', ['uses' => 'MovementOrderDetailController@store']);
        Route::delete('{id}', ['uses' => 'MovementOrderDetailController@delete']);
    });
});
