<?php

Route::group(['prefix' => 'sales', 'namespace' => 'Gelora\Sales\Http\Controllers'], function() {
    
    include('Routes/Api.php');
    include('Routes/ApiSalesPersonnel.php');
    include('Routes/Report.php');
    include('Routes/Views.php');

});

Route::group(['prefix' => 'sales-admin'], function() {
    include('Routes/RedirectApp.php'); 
});

Route::group(['prefix' => 'sales'], function() {
    
    Route::get('/', function() {
        return redirect("/gelora/sales/personnel/index.html");
    });
    
    include('Routes/RedirectApp.php'); 
});

include('Routes/Views.php');