<?php

Route::get('/gelora/inventory-management/index.html', function() {
    return view()->make('gelora.inventoryManagement::inventoryManagementIndex');
});
