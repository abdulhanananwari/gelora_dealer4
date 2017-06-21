<?php

$middlewares = ['wala.jwt.request.parser', 'wala.jwt.request.validation',
    'auth.db.overwrite'];

Route::group(['prefix' => 'views', 'namespace' => 'Views', 'middleware' => $middlewares], function() {

    Route::group(['prefix' => 'registration'], function() {
        Route::get('generate-receipt-item-handover/{id}', ['uses' => 'RegistrationController@generateReceiptItemHandover']);
        Route::get('generate-receipt-registration-cost/{id}', ['uses' => 'RegistrationController@generateReceiptRegistrationCost']);
    });

    Route::group(['prefix' => 'agency-submission-batch'], function() {
        Route::get('generate-agency-receipt/{id}', ['uses' => 'AgencySubmissionBatchController@generateAgencyReceipt']);
    });
    Route::group(['prefix' => 'leasing-bpkb-submission-batch'], function() {
        Route::get('generate-leasing-bpkb-receipt/{id}', ['uses' => 'LeasingBpkbSubmissionBatchController@generateLeasingBpkbReceipt']);
    });
});
