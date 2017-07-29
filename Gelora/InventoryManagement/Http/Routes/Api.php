<?php

$middleware = ['wala.jwt.header.parser', 'wala.jwt.header.validation',
    'auth.db.overwrite'];

Route::group(['prefix' => 'api', 'namespace' => 'Api', 'middleware' => $middleware], function() {

    Route::group(['prefix' => 'movement-order'], function() {
        Route::get('/', ['uses' => 'MovementOrderController@index','middleware' => 'auth.jwt_tumr:VIEW_MOVEMENT']);
        Route::post('close/{id}', ['uses' => 'MovementOrderController@close','middleware' => 'auth.jwt_tumr:WRITE_MOVEMENT']);
        Route::get('{id}', ['uses' => 'MovementOrderController@get','middleware' => 'auth.jwt_tumr:VIEW_MOVEMENT']);
        Route::post('/', ['uses' => 'MovementOrderController@store','middleware' => 'auth.jwt_tumr:WRITE_MOVEMENT']);
        Route::post('{id}/movement-details', ['uses' => 'MovementOrderController@addMovementOrderDetail','middleware' => 'auth.jwt_tumr:WRITE_MOVEMENT']);
        Route::post('{id}', ['uses' => 'MovementOrderController@update','middleware' => 'auth.jwt_tumr:WRITE_MOVEMENT']);
    });
});
