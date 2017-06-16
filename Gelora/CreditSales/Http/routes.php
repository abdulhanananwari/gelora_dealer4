<?php

Route::group(['prefix' => 'credit-sales', 'namespace' => '\Gelora\CreditSales\Http\Controllers'], function() {

    include('Routes/Api.php');
    include('Routes/RedirectApp.php');
    include('Routes/Views.php');
    include('Routes/Report.php');
});

Route::get('/gelora/credit-sales/index.html', function() {
    return view()->make('gelora.creditSales::creditSalesIndex');
});

Route::get('/gelora/credit-sales-leasing-app/index.html', function() {
    return view()->make('gelora.creditSales::leasingAppIndex');
});
