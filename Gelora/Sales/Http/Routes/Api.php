<?php

$middleware = ['wala.jwt.autoParse.parser', 'wala.jwt.autoParse.validation',
    'auth.db.overwrite'];

Route::group(['prefix' => 'api', 'namespace' => 'Api', 'middleware' => $middleware], function() {

    Route::group(['prefix' => 'sales-order'], function() {

        Route::get('/', ['uses' => 'SalesOrderController@index', 'middleware' => 'auth.jwt_tumr:VIEW_SALES_ORDER']);
        Route::get('{id}', ['uses' => 'SalesOrderController@get', 'middleware' => 'auth.jwt_tumr:VIEW_SALES_ORDER']);

        Route::post('/', ['uses' => 'SalesOrderController@store', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER']);
        Route::post('{id}', ['uses' => 'SalesOrderController@update', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER']);

        Route::post('{id}/calculate', ['uses' => 'SalesOrderController@calculate', 'middleware' => 'auth.jwt_tumr:VIEW_SALES_ORDER']);

        Route::group(['namespace' => 'SalesOrder'], function() {

            Route::group(['prefix' => '{id}/action', 'namespace' => 'Action'], function() {

                Route::group(['prefix' => 'validation'], function() {

                    Route::post('validate', ['uses' => 'ValidationController@validate', 'middleware' => 'auth.jwt_tumr:VALIDATE_SALES_ORDER']);
                    Route::post('unvalidate', ['uses' => 'ValidationController@unvalidate', 'middleware' => 'auth.jwt_tumr:UNVALIDATE_SALES_ORDER']);
                });

                Route::group(['prefix' => 'indent'], function() {

                    Route::post('indent', ['uses' => 'IndentController@indent']);
                });

                Route::group(['prefix' => 'financial'], function() {

                    Route::post('close', ['uses' => 'FinancialController@close', 'middleware' => 'auth.jwt_tumr:CLOSE_FINANCIAL']);
                });
            });

            Route::group(['prefix' => '{id}/specific-update'], function() {

                Route::post('price', ['uses' => 'SpecificUpdateController@price', 'middleware' => 'auth.jwt_tumr:UPDATE_SALES_ORDER_PRICE']);
                Route::post('delivery-request', ['uses' => 'SpecificUpdateController@deliveryRequest', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER']);
                Route::post('plafond', ['uses' => 'SpecificUpdateController@plafond', 'middleware' => 'auth.jwt_tumr:VALIDATE_SALES_ORDER']);
                Route::post('note', ['uses' => 'SpecificUpdateController@insertNote', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER']);
                Route::post('registration', ['uses' => 'SpecificUpdateController@registration', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER']);
                Route::post('mediator-fee-payment', ['uses' => 'SpecificUpdateController@mediatorFeePayment', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER']);
                Route::delete('customer-invoice', ['uses' => 'SpecificUpdateController@deleteCustomerInvoice', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER']);
            });

            Route::group(['prefix' => '{id}/delivery'], function() {

                Route::post('generate', ['uses' => 'DeliveryController@generate', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER_DELIVERY']);
                Route::post('/', ['uses' => 'DeliveryController@update', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER_DELIVERY']);
                Route::post('after-handover-created', ['uses' => 'DeliveryController@updateAfterHandoverCreated', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER_DELIVERY']);
                Route::post('scan', ['uses' => 'DeliveryController@scan', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER_DELIVERY_FOR_DRIVER']);
                Route::post('travel-start', ['uses' => 'DeliveryController@travelStart', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER_DELIVERY_FOR_DRIVER']);
                Route::post('handover', ['uses' => 'DeliveryController@handover', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER_DELIVERY_FOR_DRIVER']);
                Route::post('handover-confirmation', ['uses' => 'DeliveryController@handoverConfirmation', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER_DELIVERY']);
                Route::post('cancel', ['uses' => 'DeliveryController@cancel', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER_DELIVERY']);
            });

            Route::group(['prefix' => '{id}/cddb'], function() {

                Route::post('/', ['uses' => 'CddbController@update', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER']);
            });

            Route::group(['prefix' => '{id}/leasing-order'], function() {

                Route::group(['prefix' => 'join-promo-payment', 'namespace' => 'LeasingOrder'], function() {
                    Route::post('validate', ['uses' => 'JoinPromoPaymentController@validate', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER']);
                    Route::post('store', ['uses' => 'JoinPromoPaymentController@store', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER']);
                });

                Route::post('/', ['uses' => 'LeasingOrderController@update', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER']);
                Route::post('after-validation', ['uses' => 'LeasingOrderController@updateAfterValidation', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER_AFTER_VALIDATION']);
                Route::post('assign-from-leasing-order/', ['uses' => 'LeasingOrderController@assignFromLeasingOrder', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER']);
                Route::post('main-receivable-payment/', ['uses' => 'LeasingOrderController@mainReceivablePayment', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER']);

                Route::post('order-confirmation/', ['uses' => 'LeasingOrderController@orderConfirmation', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER']);
                Route::post('po-complete/', ['uses' => 'LeasingOrderController@poComplete', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER']);
            });

            Route::group(['prefix' => '{id}/pol-reg'], function() {

                Route::post('/', ['uses' => 'PolRegController@update', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER']);
                Route::post('generate-strings', ['uses' => 'PolRegController@generateStrings', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER']);
                Route::post('add-batch', ['uses' => 'PolRegController@addBatch', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER']);
                Route::post('remove-batch', ['uses' => 'PolRegController@removeBatch', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER']);

                Route::group(['namespace' => 'PolReg'], function() {

                    Route::group(['prefix' => 'item'], function() {
                        Route::post('incoming', ['uses' => 'ItemController@incoming', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER']);
                        Route::post('outgoing', ['uses' => 'ItemController@outgoing', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER']);
                    });

                    Route::post('cost', ['uses' => 'CostController@update', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER']);
                });
            });

            Route::group(['prefix' => '{id}/document', 'namespace' => 'Document'], function() {

                Route::group(['prefix' => 'spk'], function() {
                    Route::post('email', ['uses' => 'SpkController@email']);
                });
            });
        });
    });

    Route::group(['prefix' => 'prospect'], function() {

        Route::get('/', ['uses' => 'ProspectController@index', 'middleware' => 'auth.jwt_tumr:VIEW_PROSPECT']);
        Route::get('{id}', ['uses' => 'ProspectController@get', 'middleware' => 'auth.jwt_tumr:VIEW_PROSPECT']);
        Route::post('/', ['uses' => 'ProspectController@store', 'middleware' => 'auth.jwt_tumr:WRITE_PROSPECT']);
        Route::post('{id}', ['uses' => 'ProspectController@update', 'middleware' => 'auth.jwt_tumr:WRITE_PROSPECT']);
        Route::post('{id}/close', ['uses' => 'ProspectController@close', 'middleware' => 'auth.jwt_tumr:WRITE_PROSPECT']);
        Route::post('{id}/respond', ['uses' => 'ProspectController@respond', 'middleware' => 'auth.jwt_tumr:RESPOND_PROSPECT']);
    });

    Route::group(['prefix' => 'sales-order-extra'], function() {

        Route::post('/', ['uses' => 'SalesOrderExtraController@store', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER']);
        Route::post('{id}', ['uses' => 'SalesOrderExtraController@update', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER']);
        Route::delete('{id}', ['uses' => 'SalesOrderExtraController@delete', 'middleware' => 'auth.jwt_tumr:WRITE_SALES_ORDER']);
    });

    Route::group(['prefix' => 'cancelled-sales-order'], function() {

        Route::get('/', ['uses' => 'CancelledSalesOrderController@index', 'middleware' => 'auth.jwt_tumr:VIEW_CANCELLED_SALES_ORDER']);
        Route::get('{id}', ['uses' => 'CancelledSalesOrderController@get', 'middleware' => 'auth.jwt_tumr:VIEW_CANCELLED_SALES_ORDER']);
        Route::post('/', ['uses' => 'CancelledSalesOrderController@store', 'middleware' => 'auth.jwt_tumr:CANCEL_SALES_ORDER']);
    });
});
