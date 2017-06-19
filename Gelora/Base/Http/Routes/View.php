<?php

Route::group(['prefix' => 'view'], function() {

    Route::get('dealer-unit-search.html', function() {

        return file_get_contents(base_path() . '/Gelora/Base/Resources/Views/angularDirectives/dealerUnitSearch.html');
    });

    Route::get('dealer-unit-filter.html', function() {

        return file_get_contents(base_path() . '/Gelora/Base/Resources/Views/angularDirectives/dealerUnitFilter.html');
    });

    Route::get('dealer-location-finder.html', function() {

        return file_get_contents(base_path() . '/Gelora/Base/Resources/Views/angularDirectives/dealerLocationFinder.html');
    });

    Route::get('dealer-unit-barcode-finder.html', function() {

        return file_get_contents(base_path() . '/Gelora/Base/Resources/Views/angularDirectives/dealerUnitBarcodeFinder.html');
    });
    
    Route::get('dealer-unit-show.html', function() {

        return file_get_contents(base_path() . '/Gelora/Base/Resources/Views/angularDirectives/dealerUnitShow.html');
    });
});
