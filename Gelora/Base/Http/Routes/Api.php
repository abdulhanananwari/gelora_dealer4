<?php

$middleware = ['wala.jwt.header.parser', 'wala.jwt.header.validation',
    'auth.db.overwrite'];

Route::group(['prefix' => 'api', 'namespace' => 'Api', 'middleware' => $middleware], function() {

    Route::group(['prefix' => 'unit'], function() {

        Route::group(['namespace' => 'Unit'], function() {
            Route::post('assign/cost-of-good/{id}', ['uses' => 'AssignerController@costOfGood','middleware' => 'auth.jwt_tumr:ASSIGN_COST_OF_GOOD']);
        });

        Route::get('/', ['uses' => 'UnitController@index','middleware' => 'auth.jwt_tumr:VIEW_UNIT']);
        Route::get('/unique-type', ['uses' => 'UnitController@uniqueType','middleware' => 'auth.jwt_tumr:VIEW_UNIT']);
        Route::get('/{id}', ['uses' => 'UnitController@get','middleware' => 'auth.jwt_tumr:VIEW_UNIT']);

        Route::post('action/receive/{id}', ['uses' => 'UnitController@actionReceive','middleware' => 'auth.jwt_tumr:RECEIVE_UNIT']);
        Route::post('action/pdi/{id}', ['uses' => 'UnitController@actionPdi','middleware' => 'auth.jwt_tumr:PDI_UNIT']);
        Route::post('/', ['uses' => 'UnitController@store','middleware' => 'auth.jwt_tumr:WRITE_UNIT']);

        Route::post('maintenance/status/{id}', ['uses' => 'UnitController@maintenanceStatus','middleware' => 'auth.jwt_tumr:MAINTENANCE_UNIT']);
        Route::post('maintenance/location/{id}', ['uses' => 'UnitController@maintenanceLocation','middleware' => 'auth.jwt_tumr:MAINTENANCE_UNIT']);

        Route::post('{id}', ['uses' => 'UnitController@update','middleware' => 'auth.jwt_tumr:WRITE_UNIT']);
    });

    Route::group(['prefix' => 'price'], function() {

        Route::group(['namespace' => 'Price'], function() {
            Route::post('synchronize', ['uses' => 'SynchronizeController@synchronize','middleware' => 'auth.jwt_tumr:SYNCHRONIZE_PRICE']);
        });

        Route::get('/', ['uses' => 'PriceController@index','middleware' => 'auth.jwt_tumr:VIEW_PRICE']);
        Route::get('current-price-by-model-id/{id}', ['uses' => 'PriceController@currentPriceByModelId','middleware' => 'auth.jwt_tumr:VIEW_PRICE']);
        Route::get('{id}', ['uses' => 'PriceController@get','middleware' => 'auth.jwt_tumr:VIEW_PRICE']);

        Route::post('/', ['uses' => 'PriceController@store','middleware' => 'auth.jwt_tumr:WRITE_PRICE']);
        Route::put('{id}', ['uses' => 'PriceController@update','middleware' => 'auth.jwt_tumr:WRITE_PRICE']);
        Route::post('{id}', ['uses' => 'PriceController@update','middleware' => 'auth.jwt_tumr:WRITE_PRICE']);
    });

    Route::group(['prefix' => 'location'], function() {
        Route::get('/', ['uses' => 'LocationController@index','middleware' => 'auth.jwt_tumr:VIEW_LOCATION']);
        Route::get('{id}', ['uses' => 'LocationController@get','middleware' => 'auth.jwt_tumr:VIEW_LOCATION']);

        Route::post('/', ['uses' => 'LocationController@store','middleware' => 'auth.jwt_tumr:WRITE_LOCATION']);
        Route::put('{id}', ['uses' => 'LocationController@update','middleware' => 'auth.jwt_tumr:WRITE_LOCATION']);
    });
    
    Route::group(['prefix' => 'sales-program'], function() {
        Route::get('/', ['uses' => 'SalesProgramController@index','middleware' => 'auth.jwt_tumr:VIEW_SALES_PROGRAM']);
        Route::get('{id}', ['uses' => 'SalesProgramController@get','middleware' => 'auth.jwt_tumr:VIEW_SALES_PROGRAM']);

        Route::post('/', ['uses' => 'SalesProgramController@store','middleware' => 'auth.jwt_tumr:WRITE_SALES_PROGRAM']);
        Route::put('{id}', ['uses' => 'SalesProgramController@update','middleware' => 'auth.jwt_tumr:WRITE_SALES_PROGRAM']);
    });
    
    Route::group(['prefix' => 'sales-extra'], function() {
        Route::get('/', ['uses' => 'SalesExtraController@index','middleware' => 'auth.jwt_tumr:VIEW_SALES_EXTRA']);
        Route::get('{id}', ['uses' => 'SalesExtraController@get','middleware' => 'auth.jwt_tumr:VIEW_SALES_EXTRA']);

        Route::post('/', ['uses' => 'SalesExtraController@store','middleware' => 'auth.jwt_tumr:WRITE_SALES_EXTRA']);
        Route::post('{id}', ['uses' => 'SalesExtraController@update','middleware' => 'auth.jwt_tumr:WRITE_SALES_EXTRA']);
    });
});
