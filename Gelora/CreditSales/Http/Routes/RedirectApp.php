<?php

Route::group(['prefix' => 'redirect-app'], function() {
    
    Route::get('leasing-order', function() {
        
        $link = "/gelora/credit-sales/index.html#/leasingOrder/show/" .
                request("id", "") . "/" .
                request("main_leasing_id", "") . "/" .
                request("sales_order_id", "");
        
        return response('', 302, [
            'Location' => $link
        ]);
    });
    Route::group(['prefix' => 'leasing-invoice-batch'], function(){
		Route::get('{id}', function($id){
			return redirect('gelora/credit-sales/index.html#/leasingInvoiceBatch/show/' . $id);
		});
	});
});