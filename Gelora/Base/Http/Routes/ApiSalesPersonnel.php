<?php

$middleware = ['wala.jwt.header.parser', 'wala.jwt.header.validation',
    'auth.db.overwrite', 'salesPersonnelAccess:true'];

Route::group(['prefix' => 'api-sales-personnel', 'namespace' => 'Api', 'middleware' => $middleware], function() {

    Route::group(['prefix' => 'unit'], function() {

        Route::get('/', ['uses' => 'UnitController@index']);
        Route::get('/unique-type', ['uses' => 'UnitController@uniqueType']);
        Route::get('/{id}', ['uses' => 'UnitController@get']);
    });

    Route::group(['prefix' => 'price'], function() {

        Route::get('/', ['uses' => 'PriceController@index']);
        Route::get('current-price-by-model-id/{id}', ['uses' => 'PriceController@currentPriceByModelId']);
        Route::get('{id}', ['uses' => 'PriceController@get']);
    });

    Route::group(['prefix' => 'location'], function() {
        Route::get('/', ['uses' => 'LocationController@index']);
        Route::get('{id}', ['uses' => 'LocationController@get']);
    });
    
    Route::group(['prefix' => 'sales-program'], function() {
        Route::get('/', ['uses' => 'SalesProgramController@index']);
        Route::get('{id}', ['uses' => 'SalesProgramController@get']);
    });
    
    Route::group(['prefix' => 'sales-extra'], function() {
        Route::get('/', ['uses' => 'SalesExtraController@index']);
        Route::get('{id}', ['uses' => 'SalesExtraController@get']);
    });
});
