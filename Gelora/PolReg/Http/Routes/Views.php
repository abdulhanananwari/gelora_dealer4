<?php

$middlewares = ['wala.jwt.request.parser', 'wala.jwt.request.validation',
    'auth.db.overwrite'];

Route::group(['prefix' => 'views', 'namespace' => 'Views', 'middleware' => $middlewares], function() {

    Route::group(['prefix' => 'registration'], function() {
        Route::get('generate-receipt-item-handover/{id}', ['uses' => 'RegistrationController@generateReceiptItemHandover']);
        Route::get('generate-receipt-registration-cost/{id}', ['uses' => 'RegistrationController@generateReceiptRegistrationCost']);
    });

    Route::group(['prefix' => 'registration-agency-submission-batch'], function() {
        Route::get('generate-agency-receipt/{id}', ['uses' => 'RegistrationAgencySubmissionBatchController@generateAgencyReceipt']);
    });
    Route::group(['prefix' => 'registration-leasing-bpkb-submission-batch'], function() {
        Route::get('generate-leasing-bpkb-receipt/{id}', ['uses' => 'RegistrationLeasingBpkbSubmissionBatchController@generateLeasingBpkbReceipt']);
    });
});
