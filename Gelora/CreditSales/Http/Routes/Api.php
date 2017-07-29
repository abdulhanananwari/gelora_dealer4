<?php

$middleware = ['wala.jwt.header.parser', 'wala.jwt.header.validation',
    'auth.db.overwrite'];

Route::group(['prefix' => 'api', 'namespace' => 'Api', 'middleware' => $middleware], function() {

    Route::group(['prefix' => 'leasing'], function() {
        Route::get('/', ['uses' => 'LeasingController@index', 'middleware' => 'auth.jwt_tumr:VIEW_LEASING']);
        Route::get('{id}', ['uses' => 'LeasingController@get', 'middleware' => 'auth.jwt_tumr:VIEW_LEASING']);

        Route::post('/', ['uses' => 'LeasingController@store', 'middleware' => 'auth.jwt_tumr:WRITE_LEASING']);
        Route::post('{id}', ['uses' => 'LeasingController@update', 'middleware' => 'auth.jwt_tumr:WRITE_LEASING']);
    });

    Route::group(['prefix' => 'leasing-order'], function() {

        Route::get('/', ['uses' => 'LeasingOrderController@index', 'middleware' => 'auth.jwt_tumr:VIEW_LEASING_ORDER']);
        Route::get('{id}', ['uses' => 'LeasingOrderController@get', 'middleware' => 'auth.jwt_tumr:VIEW_LEASING_ORDER']);

        Route::post('/', ['uses' => 'LeasingOrderController@store', 'middleware' => 'auth.jwt_tumr:WRITE_LEASING_ORDER']);
        Route::post('{id}', ['uses' => 'LeasingOrderController@update', 'middleware' => 'auth.jwt_tumr:WRITE_LEASING_ORDER']);
    });


    Route::group(['prefix' => 'leasing-invoice-batch'], function() {
        Route::get('/', ['uses' => 'LeasingInvoiceBatchController@index', 'middleware' => 'auth.jwt_tumr:VIEW_LEASING_INVOICE_BATCH']);
        Route::get('{id}', ['uses' => 'LeasingInvoiceBatchController@get', 'middleware' => 'auth.jwt_tumr:VIEW_LEASING_INVOICE_BATCH']);

        Route::post('/', ['uses' => 'LeasingInvoiceBatchController@store', 'middleware' => 'auth.jwt_tumr:WRITE_LEASING_INVOICE_BATCH']);
        Route::post('{id}/close', ['uses' => 'LeasingInvoiceBatchController@close', 'middleware' => 'auth.jwt_tumr:WRITE_LEASING_INVOICE_BATCH']);
    });
});
