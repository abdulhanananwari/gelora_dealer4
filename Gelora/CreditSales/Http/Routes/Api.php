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

    Route::group(['prefix' => 'leasing-promo'], function() {
        Route::get('/', ['uses' => 'LeasingPromoController@index']);
        Route::get('{id}', ['uses' => 'LeasingPromoController@get']);

        Route::post('/', ['uses' => 'LeasingPromoController@store']);
        Route::post('{id}', ['uses' => 'LeasingPromoController@update']);
    });

    Route::group(['prefix' => 'leasing-program'], function() {
        Route::get('/', ['uses' => 'LeasingProgramController@index']);
        Route::get('{id}', ['uses' => 'LeasingProgramController@get']);

        Route::post('/', ['uses' => 'LeasingProgramController@store']);
        Route::post('{id}', ['uses' => 'LeasingProgramController@update']);
    });

    Route::group(['prefix' => 'leasing-order'], function() {
        Route::get('/', ['uses' => 'LeasingOrderController@index']);
        Route::get('{id}', ['uses' => 'LeasingOrderController@get']);

        Route::group(['namespace' => 'LeasingOrder'], function() {

            Route::group(['prefix' => '{id}/action', 'namespace' => 'Action'], function() {

                Route::group(['prefix' => 'validation'], function() {

                    Route::post('validate', ['uses' => 'ValidationController@validate']);
                    Route::post('unvalidate', ['uses' => 'ValidationController@unvalidate']);
                });
                Route::group(['prefix' => 'assign'], function() {
                    Route::post('leasing-program', ['uses' => 'AssignController@leasingProgram']);
                });
            });

            Route::group(['prefix' => '{id}/sales-order'], function() {
                Route::post('attach', ['uses' => 'SalesOrderController@attach']);
                Route::post('detach', ['uses' => 'SalesOrderController@detach']);
            });

            Route::group(['prefix' => '{id}/financial'], function() {
                Route::get('/', ['uses' => 'FinancialController@get']);
                Route::post('/', ['uses' => 'FinancialController@update']);
            });
        });

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

    Route::group(['prefix' => 'leasing-invoice-batch'], function() {
        Route::get('/', ['uses' => 'LeasingInvoiceBatchController@index']);
        Route::get('{id}', ['uses' => 'LeasingInvoiceBatchController@get']);

        Route::post('/', ['uses' => 'LeasingInvoiceBatchController@store']);
        Route::post('{id}/close', ['uses' => 'LeasingInvoiceBatchController@close']);
    });
});
