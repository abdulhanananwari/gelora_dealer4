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

    Route::group(['prefix' => 'leasing-invoice-batch'], function() {
        Route::get('{id}/generate-leasing-invoice-batch', ['uses' => 'LeasingInvoiceBatchController@generateLeasingInvoice', 'middleware' => 'auth.jwt_tumr:GENERATE_LEASING_INVOICE_BATCH']);
    });
});
