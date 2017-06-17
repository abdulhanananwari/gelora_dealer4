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

            Route::group(['prefix' => '{id}/cddb'], function() {
                Route::post('/', ['uses' => 'CddbController@update']);
            });

            Route::group(['prefix' => '{id}/leasing-order'], function() {
                Route::post('/', ['uses' => 'LeasingOrderController@update']);
                Route::post('assign-from-leasing-order/', ['uses' => 'LeasingOrderController@assignFromLeasingOrder']);
            });
            
            Route::group(['prefix' => '{id}/delivery'], function() {
                
                Route::post('generate', ['uses' => 'DeliveryController@generate']);
                Route::post('handover', ['uses' => 'DeliveryController@handover']);
                Route::post('cancel', ['uses' => 'DeliveryController@cancel']);
            });
            
            Route::group(['prefix' => '{id}/unit'], function() {
                Route::post('indent', ['uses' => 'UnitController@indent']);
                Route::post('deselect', ['uses' => 'UnitController@deselect']);

            });

            // Check lagi
            // Route::group(['prefix' => '{id}/delivery-detail'], function() {
            //     Route::post('generate', ['uses' => 'DeliveryController@generate']);                
            // });

            Route::group(['prefix' => '{id}/specific-update'], function() {
                Route::post('price', ['uses' => 'SpecificUpdateController@price']);
                Route::post('delivery-request', ['uses' => 'SpecificUpdateController@deliveryRequest']);

                Route::post('plafond', ['uses' => 'SpecificUpdateController@plafond']);
            });
        });
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
