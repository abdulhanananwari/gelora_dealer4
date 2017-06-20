<?php

$middleware = ['wala.jwt.header.parser', 'wala.jwt.header.validation',
    'auth.db.overwrite'];

Route::group(['prefix' => 'api', 'namespace' => 'Api', 'middleware' => $middleware], function() {

    Route::group(['prefix' => 'team'], function() {

        Route::get('/', ['uses' => 'TeamController@index']);
        Route::get('{id}', ['uses' => 'TeamController@get']);

        Route::post('/', ['uses' => 'TeamController@store']);
        Route::post('{id}', ['uses' => 'TeamController@update']);

        Route::delete('{id}', ['uses' => 'TeamController@delete']);
    });

    Route::group(['prefix' => 'personnel'], function() {

        Route::get('/', ['uses' => 'PersonnelController@index']);
        Route::get('{id}', ['uses' => 'PersonnelController@get']);

        Route::post('register-new-user', ['uses' => 'PersonnelController@registerNewUser']);
        Route::post('/', ['uses' => 'PersonnelController@store']);
        Route::post('{id}', ['uses' => 'PersonnelController@update']);

        Route::delete('{id}', ['uses' => 'PersonnelController@delete']);
    });
});
