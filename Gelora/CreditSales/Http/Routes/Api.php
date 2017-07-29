<?php

$middleware = ['wala.jwt.header.parser', 'wala.jwt.header.validation',
    'auth.db.overwrite'];

Route::group(['prefix' => 'api', 'namespace' => 'Api', 'middleware' => $middleware], function() {

    Route::group(['prefix' => 'leasing'], function() {
        Route::get('/', ['uses' => 'LeasingController@index']);
        Route::get('{id}', ['uses' => 'LeasingController@get']);

        Route::post('/', ['uses' => 'LeasingController@store']);
        Route::post('{id}', ['uses' => 'LeasingController@update']);
    });

    Route::group(['prefix' => 'leasing-order'], function() {

        Route::group(['namespace' => 'LeasingOrder'], function() {

            Route::group(['prefix' => '{id}/action', 'namespace' => 'Action'], function() {

                Route::group(['prefix' => 'validation'], function() {
                    Route::post('validate', ['uses' => 'ValidationController@validate']);
                    Route::post('unvalidate', ['uses' => 'ValidationController@unvalidate']);
                });
            });
        });

        Route::get('/', ['uses' => 'LeasingOrderController@index']);
        Route::get('{id}', ['uses' => 'LeasingOrderController@get']);

        Route::post('/', ['uses' => 'LeasingOrderController@store']);
        Route::post('{id}', ['uses' => 'LeasingOrderController@update']);
    });


    Route::group(['prefix' => 'leasing-invoice-batch'], function() {
        Route::get('/', ['uses' => 'LeasingInvoiceBatchController@index']);
        Route::get('{id}', ['uses' => 'LeasingInvoiceBatchController@get']);

        Route::post('/', ['uses' => 'LeasingInvoiceBatchController@store']);
        Route::post('{id}/close', ['uses' => 'LeasingInvoiceBatchController@close']);
    });
});
