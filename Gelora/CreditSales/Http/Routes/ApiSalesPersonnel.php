<?php

$middleware = ['wala.jwt.header.parser', 'wala.jwt.header.validation',
    'auth.db.overwrite', 'salesPersonnelAccess:true'];

Route::group(['prefix' => 'api-sales-personnel', 'namespace' => 'Api', 'middleware' => $middleware], function() {

    Route::group(['prefix' => 'leasing'], function() {
        Route::get('/', ['uses' => 'LeasingController@index']);
        Route::get('{id}', ['uses' => 'LeasingController@get']);
    });
});
