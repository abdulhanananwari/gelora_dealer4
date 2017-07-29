<?php

$middleware = ['wala.jwt.header.parser', 'wala.jwt.header.validation',
    'auth.db.overwrite'];

Route::group(['prefix' => 'api', 'namespace' => 'Api', 'middleware' => $middleware], function() {

    Route::group(['prefix' => 'team'], function() {

        Route::get('/', ['uses' => 'TeamController@index']);
        Route::get('{id}', ['uses' => 'TeamController@get']);

        Route::post('/', ['uses' => 'TeamController@store', 'middleware' => 'auth.jwt_tumr:WRITE_TEAM']);
        Route::post('{id}', ['uses' => 'TeamController@update', 'middleware' => 'auth.jwt_tumr:WRITE_TEAM']);

        Route::delete('{id}', ['uses' => 'TeamController@delete', 'middleware' => 'auth.jwt_tumr:WRITE_TEAM']);
    });

    Route::group(['prefix' => 'personnel'], function() {

        Route::get('/', ['uses' => 'PersonnelController@index']);
        Route::get('{id}', ['uses' => 'PersonnelController@get']);

        // Route::post('register-new-user', ['uses' => 'PersonnelController@registerNewUser']);
        Route::post('/', ['uses' => 'PersonnelController@store', 'middleware' => 'auth.jwt_tumr:WRITE_PERSONNEL']);
        Route::post('{id}', ['uses' => 'PersonnelController@update', 'middleware' => 'auth.jwt_tumr:WRITE_PERSONNEL']);

        Route::delete('{id}', ['uses' => 'PersonnelController@delete', 'middleware' => 'auth.jwt_tumr:WRITE_PERSONNEL']);
    });
});
