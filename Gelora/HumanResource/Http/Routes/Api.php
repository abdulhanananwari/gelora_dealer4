<?php

$middleware = ['wala.jwt.header.parser', 'wala.jwt.header.validation',
    'auth.db.overwrite'];

Route::group(['prefix' => 'api', 'namespace' => 'Api', 'middleware' => $middleware], function() {

    Route::group(['prefix' => 'team'], function() {

        Route::get('/', ['uses' => 'TeamController@index','middleware' => 'auth.jwt_tumr:VIEW_TEAM']);
        Route::get('{id}', ['uses' => 'TeamController@get','middleware' => 'auth.jwt_tumr:VIEW_TEAM']);

        Route::post('/', ['uses' => 'TeamController@store','middleware' => 'auth.jwt_tumr:WRITE_TEAM']);
        Route::post('{id}', ['uses' => 'TeamController@update','middleware' => 'auth.jwt_tumr:WRITE_TEAM']);

        Route::delete('{id}', ['uses' => 'TeamController@delete','middleware' => 'auth.jwt_tumr:WRITE_TEAM']);
    });

    Route::group(['prefix' => 'personnel'], function() {

        Route::get('/', ['uses' => 'PersonnelController@index','middleware' => 'auth.jwt_tumr:VIEW_PERSONNEL']);
        Route::get('{id}', ['uses' => 'PersonnelController@get','middleware' => 'auth.jwt_tumr:VIEW_PERSONNEL']);

        Route::post('register-new-user', ['uses' => 'PersonnelController@registerNewUser','middleware' => 'auth.jwt_tumr:REGISTER_NEW_USER']);
        Route::post('/', ['uses' => 'PersonnelController@store','middleware' => 'auth.jwt_tumr:WRITE_PERSONNEL']);
        Route::post('{id}', ['uses' => 'PersonnelController@update','middleware' => 'auth.jwt_tumr:WRITE_PERSONNEL']);

        Route::delete('{id}', ['uses' => 'PersonnelController@delete','middleware' => 'auth.jwt_tumr:WRITE_PERSONNEL']);
    });
});
