<?php

Route::group(['prefix' => 'base', 'namespace' => '\Gelora\Base\Http\Controllers'], function() {
    
    include('Routes/Api.php');
    include('Routes/Report.php');
    include('Routes/View.php');
    include('Routes/RedirectApp.php');
    
});

Route::get('/gelora/base/index.html', function() {
    return view()->make('gelora.base::baseIndex');
});