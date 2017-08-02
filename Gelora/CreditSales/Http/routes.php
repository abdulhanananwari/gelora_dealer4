<?php

Route::group(['prefix' => 'credit-sales', 'namespace' => '\Gelora\CreditSales\Http\Controllers'], function() {

    include('Routes/Api.php');
    include('Routes/ApiSalesPersonnel.php');
    include('Routes/RedirectApp.php');
    include('Routes/Views.php');
    include('Routes/Report.php');
    include('Routes/LeasingApp/Api.php');
});

Route::get('/gelora/credit-sales/index.html', function() {
    return view()->make('gelora.creditSales::creditSalesIndex');
});

Route::get('/gelora/credit-sales-leasing-app/index.html', function() {
    return view()->make('gelora.creditSales::leasingAppIndex');
});

Route::get('leasing', function() {
    return redirect('/gelora/credit-sales-leasing-app/index.html');
});