<?php

$middleware = ['wala.jwt.autoParse.parser', 'wala.jwt.autoParse.validation',
    'auth.db.overwrite', 'salesPersonnelAccess'];

Route::group(['prefix' => 'api-sales-personnel', 'namespace' => 'Api', 'middleware' => $middleware], function() {

    Route::group(['prefix' => 'prospect'], function() {
        
        Route::get('/', ['uses' => 'ProspectController@index']);
        Route::get('{id}', ['uses' => 'ProspectController@get']);
        Route::post('/', ['uses' => 'ProspectController@store']);
        Route::post('{id}', ['uses' => 'ProspectController@update']);
        Route::post('{id}/close', ['uses' => 'ProspectController@close']);
        Route::post('{id}/respond', ['uses' => 'ProspectController@respond']);
    });
    
    Route::group(['prefix' => 'sales-order'], function() {

        Route::get('/', ['uses' => 'SalesOrderController@index']);
        Route::get('{id}', ['uses' => 'SalesOrderController@get']);
        Route::post('/', ['uses' => 'SalesOrderController@store']);
        Route::post('{id}', ['uses' => 'SalesOrderController@update']);
        Route::post('{id}/close', ['uses' => 'SalesOrderController@close']);
        Route::post('{id}/respond', ['uses' => 'SalesOrderController@respond']);
    });
});
