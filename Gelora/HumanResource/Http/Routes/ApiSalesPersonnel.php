<?php

$middleware = ['wala.jwt.header.parser', 'wala.jwt.header.validation',
    'auth.db.overwrite', 'salesPersonnelAccess:true'];

Route::group(['prefix' => 'api-sales-personnel', 'namespace' => 'Api', 'middleware' => $middleware], function() {

    Route::group(['prefix' => 'team'], function() {

        Route::get('/', ['uses' => 'TeamController@index']);
        Route::get('{id}', ['uses' => 'TeamController@get']);
    });

    Route::group(['prefix' => 'personnel'], function() {

        Route::get('/', ['uses' => 'PersonnelController@index']);
        Route::get('{id}', ['uses' => 'PersonnelController@get']);
    });
});
