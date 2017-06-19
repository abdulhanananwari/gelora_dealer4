<?php

$middleware = ['wala.jwt.autoParse.parser', 'wala.jwt.autoParse.validation',
    'auth.db.overwrite'];

Route::group(['prefix' => 'report', 'namespace' => 'Report', 'middleware' => $middleware], function() {

    Route::group(['prefix' => 'registration'], function() {
        Route::get('/', ['uses' => 'RegistrationController@index']);
    });
});


