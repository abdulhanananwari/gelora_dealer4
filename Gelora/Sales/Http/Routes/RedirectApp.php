<?php

Route::group(['prefix' => 'redirect-app'], function() {
    Route::get('sales-order', function() {
        $link = "/gelora/sales/admin/index.html#/salesOrder/show/" .
                request("id", "");
        return response('', 302, ['Location' => $link]);
    });
});
