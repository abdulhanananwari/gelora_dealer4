<?php

$middleware = ['wala.jwt.autoParse.parser', 'wala.jwt.autoParse.validation',
    'auth.db.overwrite'];

Route::group(['prefix' => 'report', 'namespace' => 'Report', 'middleware' => $middleware], function() {

    Route::group(['prefix' => 'price'], function() {
        Route::get('/', ['uses' => 'PriceController@index']);
    });

    Route::group(['prefix' => 'unit'], function() {
    	Route::get('/', ['uses' => 'UnitController@index']);
    });

});
