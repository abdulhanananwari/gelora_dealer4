<?php

$middlewares = ['wala.jwt.request.parser', 'wala.jwt.request.validation',
    'auth.db.overwrite'];

Route::group(['prefix' => 'views', 'namespace' => 'Views', 'middleware' => $middlewares], function() {

    Route::group(['prefix' => 'sales-order'], function() {
        Route::get('financial/generate-customer-invoice/{id}', ['uses' => 'SalesOrderController@generateCustomerInvoice']);
        
        Route::get('delivery/generate-delivery-note/{id}', ['uses' => 'SalesOrderController@generateDeliveryNote']);
        
        Route::get('pol-reg/generate-receipt-item-handover/{id}', ['uses' => 'SalesOrderController@generateReceiptItemHandover']);
        
        Route::get('leasing-order/generate-leasing-order-invoice/{id}', ['uses' => 'SalesOrderController@generateLeasingOrderInvoice']);
        Route::get('leasing-order/generate-extra-document-invoice/{id}', ['uses' => 'SalesOrderController@generateExtraDocumentInvoice']);

        Route::group(['prefix' => '{id}', 'namespace' => 'SalesOrder'], function() {
            Route::group(['prefix' => 'document'], function() {
                Route::get('spk', ['uses' => 'DocumentController@spk']);
                Route::get('service-book-barcode-label', ['uses' => 'DocumentController@serviceBookBarcodeLabel']);
            });
        });
    });
    
    Route::group(['prefix' => 'sales-order-extra'], function() {
        Route::get('{id}/generate-receipt-handover', ['uses' => 'SalesOrderExtraController@generateReceiptHandover']);
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
