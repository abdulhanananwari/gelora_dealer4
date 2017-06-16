<?php

$middlewares = ['wala.jwt.request.parser', 'wala.jwt.request.validation',
    'auth.db.overwrite'];

Route::group(['prefix' => 'views', 'namespace' => 'Views', 'middleware' => $middlewares], function() {

    Route::group(['prefix' => 'leasing-order'], function() {
        Route::group(['prefix' => '{id}/generate'], function() {

            Route::get('invoice', ['uses' => 'LeasingOrderController@generateInvoice']);
            Route::get('bpkb-agreement', ['uses' => 'LeasingOrderController@generateBpkbAgreement']);
        });
    });
});
