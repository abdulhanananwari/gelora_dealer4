<?php

$middleware = ['wala.jwt.autoParse.parser', 'wala.jwt.autoParse.validation',
    'auth.db.overwrite'];

Route::group(['prefix' => 'report', 'namespace' => 'Report', 'middleware' => $middleware], function() {

    Route::group(['prefix' => 'sales-order'], function() {
        Route::get('/', ['uses' => 'SalesOrderController@index','middleware' => 'auth.jwt_tumr:WRITE_REPORT_SALES_ORDER']);
    });
});
