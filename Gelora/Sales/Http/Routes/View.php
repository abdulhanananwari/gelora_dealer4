<?php

Route::get('/gelora/sales/admin/index.html', function() {
    return view()->make('gelora.sales::salesAdminIndex');
});

Route::get('/gelora/sales/personnel/index.html', function() {
    return view()->make('gelora.sales::salesPersonnelIndex');
});
