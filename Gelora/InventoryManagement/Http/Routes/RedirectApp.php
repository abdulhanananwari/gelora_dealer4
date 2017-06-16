<?php

Route::group(['prefix' => 'redirect-app'], function() {

    Route::group(['prefix' => 'unit'], function() {
        
        Route::get('reception/{chasis_number}', function($chasisNumber) {
            return redirect('/gelora/inventory-management/index.html#/unit/reception/' . $chasisNumber);
        });
        

        Route::get('pdi/{id}', function($id) {
            return redirect('/gelora/inventory-management/index.html#/unit/pdi/' . $id);
        });
        
        Route::get('manual-movement/{chasisNumber}', function($chasisNumber) {
            return redirect('/gelora/inventory-management/index.html#/unit/move/' . $chasisNumber);
        });
    });

});