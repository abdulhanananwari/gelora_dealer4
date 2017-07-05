<?php

Route::group(['prefix' => 'redirect-app'], function() {

    Route::group(['prefix' => 'unit'], function() {
        Route::get('{id}', function($id) {
            return redirect('/gelora/base/index.html#/unit/show/' . $id);
        });
    });

    Route::group(['prefix' => 'sales-program'], function() {
        Route::get('{id}', function($id) {
            return redirect('/gelora/base/index.html#/salesProgram/show/' . $id);
        });
    });

    Route::group(['prefix' => 'sales-extra'], function() {
        Route::get('{id}', function($id) {
            return redirect('/gelora/base/index.html#/salesExtra/show/' . $id);
        });
    });
});