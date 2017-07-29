<?php

$middleware = ['wala.jwt.header.parser', 'wala.jwt.header.validation', 'auth.db.overwrite'];

Route::group(['prefix' => 'api', 'namespace' => 'Api', 'middleware' => $middleware], function() {

    Route::group(['prefix' => 'md-submission-batch'], function() {

        Route::get('/', ['uses' => 'MdSubmissionBatchController@index','middleware' => 'auth.jwt_tumr:VIEW_MD_SUBMISSION_BATCH']);
        Route::get('{id}', ['uses' => 'MdSubmissionBatchController@show','middleware' => 'auth.jwt_tumr:VIEW_MD_SUBMISSION_BATCH']);
        Route::post('/', ['uses' => 'MdSubmissionBatchController@store','middleware' => 'auth.jwt_tumr:WRITE_MD_SUBMISSION_BATCH']);
        Route::post('{id}', ['uses' => 'MdSubmissionBatchController@update','middleware' => 'auth.jwt_tumr:WRITE_MD_SUBMISSION_BATCH']]);
        Route::post('{id}/close', ['uses' => 'MdSubmissionBatchController@close','middleware' => 'auth.jwt_tumr:WRITE_MD_SUBMISSION_BATCH']]);

        Route::post('{id}/confirm', ['uses' => 'MdSubmissionBatchController@confirm','middleware' => 'auth.jwt_tumr:WRITE_MD_SUBMISSION_BATCH']]);
        Route::post('{id}/send-email', ['uses' => 'MdSubmissionBatchController@sendEmail','middleware' => 'auth.jwt_tumr:WRITE_MD_SUBMISSION_BATCH']]);
    });

    Route::group(['prefix' => 'agency-submission-batch'], function() {

        Route::get('/', ['uses' => 'AgencySubmissionBatchController@index','middleware' => 'auth.jwt_tumr:VIEW_AGENCY_SUBMISSION_BATCH']]);
        Route::get('{id}', ['uses' => 'AgencySubmissionBatchController@show','middleware' => 'auth.jwt_tumr:VIEW_AGENCY_SUBMISSION_BATCH']);
        Route::post('/', ['uses' => 'AgencySubmissionBatchController@store','middleware' => 'auth.jwt_tumr:WRITE_AGENCY_SUBMISSION_BATCH']);
        Route::post('{id}', ['uses' => 'AgencySubmissionBatchController@update','middleware' => 'auth.jwt_tumr:WRITE_AGENCY_SUBMISSION_BATCH']);
        Route::post('close/{id}', ['uses' => 'AgencySubmissionBatchController@close','middleware' => 'auth.jwt_tumr:WRITE_AGENCY_SUBMISSION_BATCH']);
        Route::post('handover/{id}', ['uses' => 'AgencySubmissionBatchController@handover','middleware' => 'auth.jwt_tumr:WRITE_AGENCY_SUBMISSION_BATCH']);
    });

    Route::group(['prefix' => 'agency-invoice'], function() {

        Route::get('/', ['uses' => 'AgencyInvoiceController@index','middleware' => 'auth.jwt_tumr:VIEW_AGENCY_INVOICE']);
        Route::get('{id}', ['uses' => 'AgencyInvoiceController@show','middleware' => 'auth.jwt_tumr:VIEW_AGENCY_INVOICE']);
        Route::post('/', ['uses' => 'AgencyInvoiceController@store','middleware' => 'auth.jwt_tumr:WRITE_AGENCY_INVOICE']);
        Route::post('{id}', ['uses' => 'AgencyInvoiceController@update','middleware' => 'auth.jwt_tumr:WRITE_AGENCY_INVOICE']);
        Route::post('close/{id}', ['uses' => 'AgencyInvoiceController@close','middleware' => 'auth.jwt_tumr:WRITE_AGENCY_INVOICE']);
    });

    Route::group(['prefix' => 'leasing-bpkb-submission-batch'], function() {

        Route::get('/', ['uses' => 'LeasingBpkbSubmissionBatchController@index','middleware' => 'auth.jwt_tumr:VIEW_LEASING_BPKB_SUBMISSION_BATCH']);
        Route::get('{id}', ['uses' => 'LeasingBpkbSubmissionBatchController@show','middleware' => 'auth.jwt_tumr:VIEW_LEASING_BPKB_SUBMISSION_BATCH']);
        Route::post('/', ['uses' => 'LeasingBpkbSubmissionBatchController@store','middleware' => 'auth.jwt_tumr:WRITE_LEASING_BPKB_SUBMISSION_BATCH']);
        Route::post('{id}', ['uses' => 'LeasingBpkbSubmissionBatchController@update','middleware' => 'auth.jwt_tumr:WRITE_LEASING_BPKB_SUBMISSION_BATCH']);
        Route::post('close/{id}', ['uses' => 'LeasingBpkbSubmissionBatchController@close','middleware' => 'auth.jwt_tumr:WRITE_LEASING_BPKB_SUBMISSION_BATCH']);
        Route::post('handover/{id}', ['uses' => 'LeasingBpkbSubmissionBatchController@handover','middleware' => 'auth.jwt_tumr:WRITE_LEASING_BPKB_SUBMISSION_BATCH']);
    });
});
