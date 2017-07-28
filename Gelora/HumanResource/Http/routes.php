<?php

Route::group(['prefix' => 'human-resource', 'namespace' => 'Gelora\HumanResource\Http\Controllers'], function() {
    
    include('Routes/Api.php');
    include('Routes/Trigger.php');
    
});

Route::get('/gelora/human-resource/index.html', function() {
    return view()->make('gelora.humanResource::humanResourceIndex');
});