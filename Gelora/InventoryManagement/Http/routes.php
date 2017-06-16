<?php

Route::group(['prefix' => 'inventory-management', 'namespace' => '\Gelora\InventoryManagement\Http\Controllers'], function() {

    include('Routes/Api.php');
    include('Routes/RedirectApp.php');
});

include('Routes/View.php');