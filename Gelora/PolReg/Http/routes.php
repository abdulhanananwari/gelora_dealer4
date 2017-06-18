<?php

Route::group(['prefix' => 'pol-reg', 'namespace' => '\Gelora\PolReg\Http\Controllers'], function() {
    include('Routes/Api.php');
    include('Routes/Views.php');
    include('Routes/RedirectApp.php');
    include('Routes/Report.php');
});

Route::get('/gelora/pol-reg/index.html', function() {
    return view()->make('gelora.polReg::polRegIndex');
});
