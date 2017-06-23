<?php

$middlewares = ['wala.jwt.request.parser', 'wala.jwt.request.validation', 
    'auth.db.overwrite'];

 Route::group(['prefix' => 'views', 'namespace' => 'Views', 'middleware' => $middlewares], function() {
 	
 		Route::group(['prefix' => 'sales-order'], function() {
 			Route::get('delivery/generate-note/{id}',['uses' => 'SalesOrderController@generateNote']);
 			Route::get('pol-reg/generate-receipt-costs/{id}', ['uses' => 'SalesOrderController@generateRecepitCosts']);
 			Route::get('pol-reg/generate-receipt-item-handover/{id}', ['uses' => 'SalesOrderController@generateReceiptItemHandover']);
 			Route::get('leasing-order/generate-invoice/{id}',['uses' => 'SalesOrderController@generateInvoice']);
 			Route::get('leasing-order/generate-agreementBPKB/{id}',['uses' => 'SalesOrderController@generateAgreementBPKB']);
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
