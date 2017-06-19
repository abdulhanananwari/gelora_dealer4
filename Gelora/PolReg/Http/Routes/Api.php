<?php

$middleware = ['wala.jwt.header.parser', 'wala.jwt.header.validation',
    'auth.db.overwrite'];

Route::group(['prefix' => 'api', 'namespace' => 'Api', 'middleware' => $middleware], function() {

    Route::group(['prefix' => 'registration'], function() {

        Route::group(['namespace' => 'Registration'], function() {

            Route::group(['prefix' => '{id}/update/'], function() {
                Route::post('md-submission-batch', ['uses' => 'UpdateController@mdSubmissionBatch']);
                Route::post('confirm-md-submission-batch', ['uses' => 'UpdateController@confirmMdSubmissionBatch']);
                Route::post('agency-submission-batch', ['uses' => 'UpdateController@agencySubmissionBatch']);
                Route::post('agency-invoice', ['uses' => 'UpdateController@agencyInvoice']);
                Route::post('leasing-bpkb-submission-batch', ['uses' => 'UpdateController@leasingBpkbSubmissionBatch']);
                Route::post('amount', ['uses' => 'UpdateController@amount']);
                Route::post('handover-from-agency', ['uses' => 'UpdateController@handoverFromAgency']);
                Route::post('handover-to-customer', ['uses' => 'UpdateController@handoverToCustomer']);
                Route::post('item/incoming', ['uses' => 'UpdateController@itemIncoming']);
                Route::post('item/outgoing', ['uses' => 'UpdateController@itemOutgoing']);
                Route::post('cost', ['uses' => 'UpdateController@cost']);
            });

            Route::group(['prefix' => '{id}/cancel'], function() {
                Route::post('md-submission-batch', ['uses' => 'CancelController@mdSubmissionBatch']);
                Route::post('agency-submission-batch', ['uses' => 'CancelController@agencySubmissionBatch']);
                Route::post('agency-invoice', ['uses' => 'CancelController@agencyInvoice']);
                Route::post('leasing-bpkb-submission-batch', ['uses' => 'CancelController@leasingBpkbSubmissionBatch']);
                Route::post('pending-md-submission-batch', ['uses' => 'CancelController@pendingMdSubmissionBatch']);
                Route::post('pending-agency-submission-batch', ['uses' => 'CancelController@pendingAgencySubmissionBatch']);
                Route::post('pending-leasing-bpkb-submission-batch', ['uses' => 'CancelController@pendingLeasingBpkbSubmissionBatch']);
            });
            Route::group(['prefix' => '{id}/pending'], function() {
                Route::post('md-submission-batch', ['uses' => 'PendingController@mdSubmissionBatch']);
                Route::post('agency-submission-batch', ['uses' => 'PendingController@agencySubmissionBatch']);
                Route::post('leasing-bpkb-submission-batch', ['uses' => 'PendingController@leasingBpkbSubmissionBatch']);
            });

            Route::post('generate-from-delivery', ['uses' => 'ActionController@generateFromDelivery']);
        });

        Route::get('/', ['uses' => 'RegistrationController@index']);
        Route::get('{id}', ['uses' => 'RegistrationController@show']);
    });

    Route::group(['prefix' => 'registration-md-submission-batch'], function() {

        Route::get('/', ['uses' => 'RegistrationMdSubmissionBatchController@index']);
        Route::get('{id}', ['uses' => 'RegistrationMdSubmissionBatchController@show']);
        Route::post('/', ['uses' => 'RegistrationMdSubmissionBatchController@store']);
        Route::post('{id}', ['uses' => 'RegistrationMdSubmissionBatchController@update']);
        Route::post('{id}/close', ['uses' => 'RegistrationMdSubmissionBatchController@close']);

        Route::post('{id}/confirm', ['uses' => 'RegistrationMdSubmissionBatchController@confirm']);
        Route::post('{id}/send-email', ['uses' => 'RegistrationMdSubmissionBatchController@sendEmail']);
    });

    Route::group(['prefix' => 'registration-agency-submission-batch'], function() {

        Route::get('/', ['uses' => 'RegistrationAgencySubmissionBatchController@index']);
        Route::get('{id}', ['uses' => 'RegistrationAgencySubmissionBatchController@show']);
        Route::post('/', ['uses' => 'RegistrationAgencySubmissionBatchController@store']);
        Route::post('{id}', ['uses' => 'RegistrationAgencySubmissionBatchController@update']);
        Route::post('close/{id}', ['uses' => 'RegistrationAgencySubmissionBatchController@close']);
        Route::post('handover/{id}', ['uses' => 'RegistrationAgencySubmissionBatchController@handover']);
    });

    Route::group(['prefix' => 'registration-agency-invoice'], function() {

        Route::get('/', ['uses' => 'RegistrationAgencyInvoiceController@index']);
        Route::get('{id}', ['uses' => 'RegistrationAgencyInvoiceController@show']);
        Route::post('/', ['uses' => 'RegistrationAgencyInvoiceController@store']);
        Route::post('{id}', ['uses' => 'RegistrationAgencyInvoiceController@update']);
        Route::post('close/{id}', ['uses' => 'RegistrationAgencyInvoiceController@close']);
    });

    Route::group(['prefix' => 'registration-leasing-bpkb-submission-batch'], function() {

        Route::get('/', ['uses' => 'RegistrationLeasingBpkbSubmissionBatchController@index']);
        Route::get('{id}', ['uses' => 'RegistrationLeasingBpkbSubmissionBatchController@show']);
        Route::post('/', ['uses' => 'RegistrationLeasingBpkbSubmissionBatchController@store']);
        Route::post('{id}', ['uses' => 'RegistrationLeasingBpkbSubmissionBatchController@update']);
        Route::post('close/{id}', ['uses' => 'RegistrationLeasingBpkbSubmissionBatchController@close']);
        Route::post('handover/{id}', ['uses' => 'RegistrationLeasingBpkbSubmissionBatchController@close']);
    });
});
