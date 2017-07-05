<?php

$middleware = ['wala.jwt.header.parser', 'wala.jwt.header.validation',
    'auth.db.overwrite'];

Route::group(['prefix' => 'api', 'namespace' => 'Api', 'middleware' => $middleware], function() {

    Route::group(['prefix' => 'unit'], function() {

        Route::group(['namespace' => 'Unit'], function() {
            Route::post('assign/cost-of-good/{id}', ['uses' => 'AssignerController@costOfGood']);
        });

        Route::get('/', ['uses' => 'UnitController@index']);
        Route::get('/unique-type', ['uses' => 'UnitController@uniqueType']);
        Route::get('/{id}', ['uses' => 'UnitController@get']);

        Route::post('action/receive/{id}', ['uses' => 'UnitController@actionReceive']);
        Route::post('action/pdi/{id}', ['uses' => 'UnitController@actionPdi']);
        Route::post('/', ['uses' => 'UnitController@store']);

        Route::post('maintenance/status/{id}', ['uses' => 'UnitController@maintenanceStatus']);
        Route::post('maintenance/location/{id}', ['uses' => 'UnitController@maintenanceLocation']);

        Route::post('{id}', ['uses' => 'UnitController@update']);
    });

    Route::group(['prefix' => 'price'], function() {

        Route::group(['namespace' => 'Price'], function() {
            Route::post('synchronize', ['uses' => 'SynchronizeController@synchronize']);

            Route::group(['prefix' => 'extensive'], function() {
                Route::get('/', ['uses' => 'PriceExtensiveController@index']);
                Route::get('{id}', ['uses' => 'PriceExtensiveController@get']);

                Route::post('/', ['uses' => 'PriceExtensiveController@store']);
                Route::put('{id}', ['uses' => 'PriceExtensiveController@update']);
                Route::post('{id}', ['uses' => 'PriceExtensiveController@update']);
            });
        });

        Route::get('/', ['uses' => 'PriceController@index']);
        Route::get('current-price-by-model-id/{id}', ['uses' => 'PriceController@currentPriceByModelId']);
        Route::get('{id}', ['uses' => 'PriceController@get']);

        Route::post('/', ['uses' => 'PriceController@store']);
        Route::put('{id}', ['uses' => 'PriceController@update']);
        Route::post('{id}', ['uses' => 'PriceController@update']);
    });

    Route::group(['prefix' => 'location'], function() {
        Route::get('/', ['uses' => 'LocationController@index']);
        Route::get('{id}', ['uses' => 'LocationController@get']);

        Route::post('/', ['uses' => 'LocationController@store']);
        Route::put('{id}', ['uses' => 'LocationController@update']);
    });
    
    Route::group(['prefix' => 'sales-program'], function() {
        Route::get('/', ['uses' => 'SalesProgramController@index']);
        Route::get('{id}', ['uses' => 'SalesProgramController@get']);

        Route::post('/', ['uses' => 'SalesProgramController@store']);
        Route::put('{id}', ['uses' => 'SalesProgramController@update']);
    });
    
    Route::group(['prefix' => 'sales-extra'], function() {
        Route::get('/', ['uses' => 'SalesExtraController@index']);
        Route::get('{id}', ['uses' => 'SalesExtraController@get']);

        Route::post('/', ['uses' => 'SalesExtraController@store']);
        Route::post('{id}', ['uses' => 'SalesExtraController@update']);
    });
});
