<?php

$middleware = ['auth.db.manualOverwrite:tenantId'];

Route::group(['prefix' => '{tenantId}/trigger', 'middleware' => $middleware], function() {
    
    Route::get('update-personnel-name', function(Illuminate\Http\Request $request) {
       
        $personnels = Gelora\HumanResource\App\Personnel\PersonnelModel::get();
        
        foreach ($personnels as $personnel) {
            
            $personnel->setAttribute('name', $personnel->getAttribute('entity.name'));
            $personnel->save();
        }
        
        if ($request->get('so_too') == 'true') {
            
            $salesOrders = \Gelora\Sales\App\SalesOrder\SalesOrderModel::get();
            foreach ($salesOrders as $salesOrder) {
                
                $salesName = $salesOrder->getAttribute('salesPersonnel.entity.name');
                if ($salesName) {
                    $salesOrder->setAttribute('salesPersonnel.name', $salesName);
                    $salesOrder->save();
                }
                
            }
        }
        
        
    });
});
