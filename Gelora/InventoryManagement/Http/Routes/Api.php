<?php

$middleware = ['wala.jwt.header.parser', 'wala.jwt.header.validation',
    'auth.db.overwrite'];

Route::group(['prefix' => 'api', 'namespace' => 'Api', 'middleware' => $middleware], function() {

    Route::group(['prefix' => 'movement-order'], function() {
        Route::get('/', ['uses' => 'MovementOrderController@index']);
        Route::post('close/{id}', ['uses' => 'MovementOrderController@close']);
        Route::get('{id}', ['uses' => 'MovementOrderController@get']);
        Route::post('/', ['uses' => 'MovementOrderController@store']);
        Route::post('{id}/movement-details', ['uses' => 'MovementOrderController@addMovementOrderDetail']);
        Route::post('{id}', ['uses' => 'MovementOrderController@update']);
    });
});
