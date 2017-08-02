<?php

$middlewares = ['wala.jwt.request.parser', 'wala.jwt.request.validation',
    'auth.db.overwrite'];

Route::group(['prefix' => 'views', 'namespace' => 'Views', 'middleware' => $middlewares], function() {

    Route::group(['prefix' => 'sales-order'], function() {
        Route::get('financial/generate-customer-invoice/{id}', ['uses' => 'SalesOrderController@generateCustomerInvoice', 'middleware' => 'auth.jwt_tumr:GENERATE_CUSTOMER_INVOICE']);

        Route::get('delivery/generate-delivery-note/{id}', ['uses' => 'SalesOrderController@generateDeliveryNote', 'middleware' => 'auth.jwt_tumr:GENERATE_DELIVERY_NOTE']);

        Route::get('pol-reg/generate-receipt-item-handover/{id}', ['uses' => 'SalesOrderController@generateReceiptItemHandover', 'middleware' => 'auth.jwt_tumr:GENERATE_RECEIPT_ITEM_HANDOVER']);

        Route::get('leasing-order/generate-leasing-order-invoice/{id}', ['uses' => 'SalesOrderController@generateLeasingOrderInvoice', 'middleware' => 'auth.jwt_tumr:GENERATE_LEASING_ORDER_INVOICE']);
        Route::get('leasing-order/generate-extra-document-invoice/{id}', ['uses' => 'SalesOrderController@generateExtraDocumentInvoice', 'middleware' => 'auth.jwt_tumr:GENERATE_LEASING_ORDER_INVOICE']);

        Route::group(['prefix' => '{id}', 'namespace' => 'SalesOrder'], function() {
            
            Route::group(['prefix' => 'document'], function() {
                Route::get('spk', ['uses' => 'DocumentController@spk', 'middleware' => 'auth.jwt_tumr:GENERATE_SPK_PDF']);
                Route::get('service-book-barcode-label', ['uses' => 'DocumentController@serviceBookBarcodeLabel', 'middleware' => 'auth.jwt_tumr:GENERATE_BARCODE_LABEL']);
            });
        });
    });

    Route::group(['prefix' => 'sales-order-extra'], function() {
        
        Route::get('{id}/generate-receipt-handover', ['uses' => 'SalesOrderExtraController@generateReceiptHandover', 'middleware' => 'auth.jwt_tumr:GENERATE_RECEIPT_SOE_HANDOVER']);
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
