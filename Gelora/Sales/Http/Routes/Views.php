<?php

$middlewares = ['wala.jwt.request.parser', 'wala.jwt.request.validation',
    'auth.db.overwrite'];

Route::group(['prefix' => 'views', 'namespace' => 'Views', 'middleware' => $middlewares], function() {

    Route::group(['prefix' => 'sales-order'], function() {
        Route::get('financial/generate-customer-invoice/{id}', ['uses' => 'SalesOrderController@generateCustomerInvoice']);
        
        Route::get('delivery/generate-delivery-note/{id}', ['uses' => 'SalesOrderController@generateDeliveryNote']);
        
        Route::get('pol-reg/generate-receipt-item-handover/{id}', ['uses' => 'SalesOrderController@generateReceiptItemHandover']);
        
        Route::get('leasing-order/generate-leasing-order-invoice/{id}', ['uses' => 'SalesOrderController@generateLeasingOrderInvoice']);
        Route::get('leasing-order/generate-agreement-bpkb/{id}', ['uses' => 'SalesOrderController@generateAgreementBPKB']);

        Route::group(['prefix' => '{id}', 'namespace' => 'SalesOrder'], function() {
            Route::group(['prefix' => 'document'], function() {
                Route::get('spk/download', ['uses' => 'SpkController@download']);
            });
        });
    });
});

Route::get('/gelora/sales/admin/index.html', function() {
    return view()->make('gelora.sales::salesAdminIndex');
});

Route::get('/gelora/sales/personnel/index.html', function() {
    return view()->make('gelora.sales::salesPersonnelIndex');
});

Route::get('/gelora/sales/delivery/index.html', function() {
    return view()->make('gelora.sales::deliveryIndex');
});
