<?php

$middleware = ['wala.jwt.header.parser', 'wala.jwt.header.validation', 'auth.db.overwrite'];

Route::group(['prefix' => 'api', 'namespace' => 'Api', 'middleware' => $middleware], function() {

    Route::group(['prefix' => 'md-submission-batch'], function() {

        Route::get('/', ['uses' => 'MdSubmissionBatchController@index']);
        Route::get('{id}', ['uses' => 'MdSubmissionBatchController@show']);
        Route::post('/', ['uses' => 'MdSubmissionBatchController@store']);
        Route::post('{id}', ['uses' => 'MdSubmissionBatchController@update']);
        Route::post('{id}/close', ['uses' => 'MdSubmissionBatchController@close']);

        Route::post('{id}/confirm', ['uses' => 'MdSubmissionBatchController@confirm']);
        Route::post('{id}/send-email', ['uses' => 'MdSubmissionBatchController@sendEmail']);
    });

    Route::group(['prefix' => 'agency-submission-batch'], function() {

        Route::get('/', ['uses' => 'AgencySubmissionBatchController@index']);
        Route::get('{id}', ['uses' => 'AgencySubmissionBatchController@show']);
        Route::post('/', ['uses' => 'AgencySubmissionBatchController@store']);
        Route::post('{id}', ['uses' => 'AgencySubmissionBatchController@update']);
        Route::post('close/{id}', ['uses' => 'AgencySubmissionBatchController@close']);
        Route::post('handover/{id}', ['uses' => 'AgencySubmissionBatchController@handover']);
    });

    Route::group(['prefix' => 'agency-invoice'], function() {

        Route::get('/', ['uses' => 'AgencyInvoiceController@index']);
        Route::get('{id}', ['uses' => 'AgencyInvoiceController@show']);
        Route::post('/', ['uses' => 'AgencyInvoiceController@store']);
        Route::post('{id}', ['uses' => 'AgencyInvoiceController@update']);
        Route::post('close/{id}', ['uses' => 'AgencyInvoiceController@close']);
    });

    Route::group(['prefix' => 'leasing-bpkb-submission-batch'], function() {

        Route::get('/', ['uses' => 'LeasingBpkbSubmissionBatchController@index']);
        Route::get('{id}', ['uses' => 'LeasingBpkbSubmissionBatchController@show']);
        Route::post('/', ['uses' => 'LeasingBpkbSubmissionBatchController@store']);
        Route::post('{id}', ['uses' => 'LeasingBpkbSubmissionBatchController@update']);
        Route::post('close/{id}', ['uses' => 'LeasingBpkbSubmissionBatchController@close']);
        Route::post('handover/{id}', ['uses' => 'LeasingBpkbSubmissionBatchController@close']);
    });
});
