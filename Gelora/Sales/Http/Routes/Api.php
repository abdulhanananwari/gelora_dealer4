<?php

$middleware = ['wala.jwt.autoParse.parser', 'wala.jwt.autoParse.validation',
    'auth.db.overwrite'];

Route::group(['prefix' => 'api', 'namespace' => 'Api', 'middleware' => $middleware], function() {

    Route::group(['prefix' => 'sales-order'], function() {

        Route::get('/', ['uses' => 'SalesOrderController@index', 'middleware' => 'auth.jwt_tumr:VIEW_SALES_ORDER'
        ]);
        Route::get('{id}', ['uses' => 'SalesOrderController@get', 'middleware' => 'auth.jwt_tumr:VIEW_SALES_ORDER'
        ]);

        Route::post('/', ['uses' => 'SalesOrderController@store', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER'
        ]);
        Route::post('{id}', ['uses' => 'SalesOrderController@update', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER'
        ]);

        Route::post('{id}/calculate', ['uses' => 'SalesOrderController@calculate', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER'
            ]);

        Route::group(['namespace' => 'SalesOrder'], function() {

            Route::group(['prefix' => '{id}/action', 'namespace' => 'Action'], function() {

                Route::group(['prefix' => 'lock'], function() {
                    Route::post('request', ['uses' => 'LockController@request']);
                    Route::post('lock', ['uses' => 'LockController@lock']);
                    Route::post('unlock', ['uses' => 'LockController@unlock']);
                });

                Route::group(['prefix' => 'validation'], function() {
                    Route::post('validate', ['uses' => 'ValidationController@validate', 'middleware' => 'auth.jwt_tumr:VALIDATE_SALES_ORDER']);
                    Route::post('unvalidate', ['uses' => 'ValidationController@unvalidate','middleware' => 'auth.jwt_tumr:VALIDATE_SALES_ORDER']);
                });

                Route::group(['prefix' => 'indent'], function() {
                    Route::post('indent', ['uses' => 'IndentController@indent','middleware' => 'auth.jwt_tumr:WRITE_INDENT']);
                });

                Route::group(['prefix' => 'financial'], function() {
                    Route::post('close', ['uses' => 'FinancialController@close','middleware' => 'auth.jwt_tumr:CLOSE_FINANCIAL']);
                });
            });

            Route::group(['prefix' => '{id}/specific-update'], function() {
                Route::post('price', ['uses' => 'SpecificUpdateController@price','middleware' => 'auth.jwt_tumr:WRITE_SPECIFIC_UPDATE']);
                Route::post('delivery-request', ['uses' => 'SpecificUpdateController@deliveryRequest','middleware' => 'auth.jwt_tumr:WRITE_SPECIFIC_UPDATE']);
                Route::post('plafond', ['uses' => 'SpecificUpdateController@plafond','middleware' => 'auth.jwt_tumr:WRITE_SPECIFIC_UPDATE']);
                Route::post('note', ['uses' => 'SpecificUpdateController@insertNote','middleware' => 'auth.jwt_tumr:WRITE_SPECIFIC_UPDATE']);
                Route::post('registration', ['uses' => 'SpecificUpdateController@registration','middleware' => 'auth.jwt_tumr:WRITE_SPECIFIC_UPDATE']);
                Route::post('mediator-fee-payment', ['uses' => 'SpecificUpdateController@mediatorFeePayment','middleware' => 'auth.jwt_tumr:WRITE_SPECIFIC_UPDATE']);
                Route::delete('customer-invoice', ['uses' => 'SpecificUpdateController@deleteCustomerInvoice','middleware' => 'auth.jwt_tumr:WRITE_SPECIFIC_UPDATE']);
            });

            Route::group(['prefix' => '{id}/delivery'], function() {
                Route::post('generate', ['uses' => 'DeliveryController@generate','middleware' => 'auth.jwt_tumr:WRITE_DELIVERY']);
                Route::post('/', ['uses' => 'DeliveryController@update','middleware' => 'auth.jwt_tumr:WRITE_DELIVERY']);
                Route::post('after-handover-created', ['uses' => 'DeliveryController@updateAfterHandoverCreated','middleware' => 'auth.jwt_tumr:WRITE_DELIVERY']);
                Route::post('scan', ['uses' => 'DeliveryController@scan','middleware' => 'auth.jwt_tumr:WRITE_DELIVERY']);
                Route::post('travel-start', ['uses' => 'DeliveryController@travelStart','middleware' => 'auth.jwt_tumr:WRITE_DELIVERY']);
                Route::post('handover', ['uses' => 'DeliveryController@handover','middleware' => 'auth.jwt_tumr:WRITE_DELIVERY']);
                Route::post('handover-confirmation', ['uses' => 'DeliveryController@handoverConfirmation','middleware' => 'auth.jwt_tumr:WRITE_DELIVERY']);
                Route::post('cancel', ['uses' => 'DeliveryController@cancel','middleware' => 'auth.jwt_tumr:WRITE_DELIVERY']);
            });

            Route::group(['prefix' => '{id}/unit'], function() {
                Route::post('indent', ['uses' => 'UnitController@indent','middleware' => 'auth.jwt_tumr:WRITE_UNIT']);
                Route::post('deselect', ['uses' => 'UnitController@deselect','middleware' => 'auth.jwt_tumr:WRITE_UNIT']);
            });

            Route::group(['prefix' => '{id}/cddb'], function() {
                Route::post('/', ['uses' => 'CddbController@update','middleware' => 'auth.jwt_tumr:WRITE_CDDB']);
            });

            Route::group(['prefix' => '{id}/leasing-order'], function() {
                Route::post('/', ['uses' => 'LeasingOrderController@update','middleware' => 'auth.jwt_tumr:WRITE_LEASING_ORDER']);
                Route::post('after-validation', ['uses' => 'LeasingOrderController@updateAfterValidation','middleware' => 'auth.jwt_tumr:WRITE_LEASING_ORDER']);
                Route::post('assign-from-leasing-order/', ['uses' => 'LeasingOrderController@assignFromLeasingOrder','middleware' => 'auth.jwt_tumr:WRITE_LEASING_ORDER']);
                Route::post('payment-received/', ['uses' => 'LeasingOrderController@mainReceivablePayment','middleware' => 'auth.jwt_tumr:WRITE_PAYMENT_LEASING_ORDER']);
                Route::post('main-receivable-payment/', ['uses' => 'LeasingOrderController@mainReceivablePayment','middleware' => 'auth.jwt_tumr:WRITE_PAYMENT_LEASING_ORDER']);
                Route::post('join-promo-payment/', ['uses' => 'LeasingOrderController@joinPromoPayment','middleware' => 'auth.jwt_tumr:WRITE_PAYMENT_LEASING_ORDER']);

                Route::post('order-confirmation/', ['uses' => 'LeasingOrderController@orderConfirmation','middleware' => 'auth.jwt_tumr:WRITE_LEASING_ORDER']);
                Route::post('po-complete/', ['uses' => 'LeasingOrderController@poComplete','middleware' => 'auth.jwt_tumr:WRITE_LEASING_ORDER']);
            });

            Route::group(['prefix' => '{id}/pol-reg'], function() {

                Route::post('/', ['uses' => 'PolRegController@update','middleware' => 'auth.jwt_tumr:WRITE_POLREG']);
                Route::post('generate-strings', ['uses' => 'PolRegController@generateStrings','middleware' => 'auth.jwt_tumr:WRITE_POLREG']);
                Route::post('add-batch', ['uses' => 'PolRegController@addBatch','middleware' => 'auth.jwt_tumr:WRITE_POLREG']);
                Route::post('remove-batch', ['uses' => 'PolRegController@removeBatch','middleware' => 'auth.jwt_tumr:WRITE_POLREG']);

                Route::group(['namespace' => 'PolReg'], function() {
                    Route::group(['prefix' => 'item'], function() {
                        Route::post('incoming', ['uses' => 'ItemController@incoming','middleware' => 'auth.jwt_tumr:WRITE_POLREG']);
                        Route::post('outgoing', ['uses' => 'ItemController@outgoing','middleware' => 'auth.jwt_tumr:WRITE_POLREG']);
                    });
                    Route::post('cost', ['uses' => 'CostController@update','middleware' => 'auth.jwt_tumr:WRITE_POLREG']);
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

        Route::get('/', ['uses' => 'ProspectController@index','middleware' => 'auth.jwt_tumr:VIEW_PROSPECT']);
        Route::get('{id}', ['uses' => 'ProspectController@get','middleware' => 'auth.jwt_tumr:VIEW_PROSPECT']);
        Route::post('/', ['uses' => 'ProspectController@store','middleware' => 'auth.jwt_tumr:WRITE_PROSPECT']);
        Route::post('{id}', ['uses' => 'ProspectController@update','middleware' => 'auth.jwt_tumr:WRITE_PROSPECT']);
        Route::post('{id}/close', ['uses' => 'ProspectController@close','middleware' => 'auth.jwt_tumr:CLOSE_PROSPECT']);
        Route::post('{id}/respond', ['uses' => 'ProspectController@respond','middleware' => 'auth.jwt_tumr:RESPOND_PROSPECT']);
    });

    Route::group(['prefix' => 'sales-order-extra'], function() {
        Route::post('/', ['uses' => 'SalesOrderExtraController@store','middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER_EXTRA']);
        Route::post('{id}', ['uses' => 'SalesOrderExtraController@update','middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER_EXTRA']);
        Route::delete('{id}', ['uses' => 'SalesOrderExtraController@delete',,'middleware' => 'auth.jwt_tumr:DELETE_SALES_ORDER_EXTRA']);
    });

    Route::group(['prefix' => 'cancelled-sales-order'], function() {

        Route::get('/', ['uses' => 'CancelledSalesOrderController@index','middleware' => 'auth.jwt_tumr:VIEW_CANCELLED_SALES_ORDER']);
        Route::get('{id}', ['uses' => 'CancelledSalesOrderController@get','middleware' => 'auth.jwt_tumr:VIEW_CANCELLED_SALES_ORDER']);
        Route::post('/', ['uses' => 'CancelledSalesOrderController@store','middleware' => 'auth.jwt_tumr:WRITE_CANCELLED_SALES_ORDER']);

        Route::post('{id}/restore', ['uses' => 'CancelledSalesOrderController@restore','middleware' => 'auth.jwt_tumr:WRITE_CANCELLED_SALES_ORDER']);
        Route::post('{id}', ['uses' => 'CancelledSalesOrderController@update','middleware' => 'auth.jwt_tumr:WRITE_CANCELLED_SALES_ORDER']);
    });
});
