<?php

$middleware = ['wala.jwt.autoParse.parser', 'wala.jwt.autoParse.validation',
    'auth.db.overwrite'];

Route::group(['prefix' => 'api', 'namespace' => 'Api', 'middleware' => $middleware], function() {

    Route::group(['prefix' => 'sales-order'], function() {

        Route::get('/', ['uses' => 'SalesOrderController@index']);
        Route::get('{id}', ['uses' => 'SalesOrderController@get']);

        Route::post('/', ['uses' => 'SalesOrderController@store']);
        Route::post('{id}', ['uses' => 'SalesOrderController@update']);

        Route::post('{id}/calculate', ['uses' => 'SalesOrderController@calculate']);

        Route::group(['namespace' => 'SalesOrder'], function() {

            Route::group(['prefix' => '{id}/action', 'namespace' => 'Action'], function() {

                Route::group(['prefix' => 'lock'], function() {
                    Route::post('request', ['uses' => 'LockController@request']);
                    Route::post('lock', ['uses' => 'LockController@lock']);
                    Route::post('unlock', ['uses' => 'LockController@unlock']);
                });

                Route::group(['prefix' => 'validation'], function() {
                    Route::post('validate', ['uses' => 'ValidationController@validate']);
                    Route::post('unvalidate', ['uses' => 'ValidationController@unvalidate']);
                });

                Route::group(['prefix' => 'indent'], function() {
                    Route::post('indent', ['uses' => 'IndentController@indent']);
                });

                Route::group(['prefix' => 'financial'], function() {
                    Route::post('close', ['uses' => 'FinancialController@close']);
                });
            });

            Route::group(['prefix' => '{id}/specific-update'], function() {
                Route::post('price', ['uses' => 'SpecificUpdateController@price']);
                Route::post('delivery-request', ['uses' => 'SpecificUpdateController@deliveryRequest']);
                Route::post('plafond', ['uses' => 'SpecificUpdateController@plafond']);
                Route::post('note', ['uses' => 'SpecificUpdateController@insertNote']);
                Route::post('registration', ['uses' => 'SpecificUpdateController@registration']);
                Route::delete('customer-invoice', ['uses' => 'SpecificUpdateController@deleteCustomerInvoice']);
            });

            Route::group(['prefix' => '{id}/delivery'], function() {
                Route::post('generate', ['uses' => 'DeliveryController@generate']);
                Route::post('/', ['uses' => 'DeliveryController@update']);
                Route::post('scan', ['uses' => 'DeliveryController@scan']);
                Route::post('travel-start', ['uses' => 'DeliveryController@travelStart']);
                Route::post('handover', ['uses' => 'DeliveryController@handover']);
                Route::post('handover-confirmation', ['uses' => 'DeliveryController@handoverConfirmation']);
                Route::post('cancel', ['uses' => 'DeliveryController@cancel']);
            });

            Route::group(['prefix' => '{id}/unit'], function() {
                Route::post('indent', ['uses' => 'UnitController@indent']);
                Route::post('deselect', ['uses' => 'UnitController@deselect']);
            });

            Route::group(['prefix' => '{id}/cddb'], function() {
                Route::post('/', ['uses' => 'CddbController@update']);
            });

            Route::group(['prefix' => '{id}/leasing-order'], function() {
                Route::post('/', ['uses' => 'LeasingOrderController@update']);
                Route::post('after-validation', ['uses' => 'LeasingOrderController@updateAfterValidation']);
                Route::post('assign-from-leasing-order/', ['uses' => 'LeasingOrderController@assignFromLeasingOrder']);
                Route::post('payment-received/', ['uses' => 'LeasingOrderController@paymentReceived']);
                Route::post('join-promo-payment/', ['uses' => 'LeasingOrderController@joinPromoPayment']);

                Route::post('po-complete/', ['uses' => 'LeasingOrderController@poComplete']);
            });

            Route::group(['prefix' => '{id}/pol-reg'], function() {

                Route::post('/', ['uses' => 'PolRegController@update']);
                Route::post('generate-strings', ['uses' => 'PolRegController@generateStrings']);
                Route::post('add-batch', ['uses' => 'PolRegController@addBatch']);
                Route::post('remove-batch', ['uses' => 'PolRegController@removeBatch']);

                Route::group(['namespace' => 'PolReg'], function() {
                    Route::group(['prefix' => 'item'], function() {
                        Route::post('incoming', ['uses' => 'ItemController@incoming']);
                        Route::post('outgoing', ['uses' => 'ItemController@outgoing']);
                    });
                    Route::post('cost', ['uses' => 'CostController@update']);
                });
            });

            Route::group(['prefix' => '{id}/document', 'namespace' => 'Document'], function() {
                Route::group(['prefix' => 'spk'], function() {
                    Route::post('generate', ['uses' => 'SpkController@generate']);
                    Route::post('email', ['uses' => 'SpkController@email']);
                });
                Route::group(['prefix' => 'faktur'], function() {
                    Route::post('generate', ['uses' => 'FakturController@generate']);
                    Route::post('email', ['uses' => 'FakturController@email']);
                });
            });
        });
    });

    Route::group(['prefix' => 'prospect'], function() {

        Route::get('/', ['uses' => 'ProspectController@index']);
        Route::get('{id}', ['uses' => 'ProspectController@get']);
        Route::post('/', ['uses' => 'ProspectController@store']);
        Route::post('{id}', ['uses' => 'ProspectController@update']);
        Route::post('{id}/close', ['uses' => 'ProspectController@close']);
        Route::post('{id}/respond', ['uses' => 'ProspectController@respond']);
    });

    Route::group(['prefix' => 'sales-order-extra'], function() {
        Route::post('/', ['uses' => 'SalesOrderExtraController@store']);
        Route::post('{id}', ['uses' => 'SalesOrderExtraController@update']);
    });

    Route::group(['prefix' => 'cancelled-sales-order'], function() {

        Route::get('/', ['uses' => 'CancelledSalesOrderController@index']);
        Route::get('{id}', ['uses' => 'CancelledSalesOrderController@get']);
        Route::post('/', ['uses' => 'CancelledSalesOrderController@store']);

        Route::post('{id}/restore', ['uses' => 'CancelledSalesOrderController@restore']);
        Route::post('{id}', ['uses' => 'CancelledSalesOrderController@update']);
    });
});
