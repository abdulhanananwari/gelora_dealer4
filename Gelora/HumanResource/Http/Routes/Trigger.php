<?php

$middleware = ['auth.db.manualOverwrite:tenantId'];

Route::group(['prefix' => '{tenantId}/trigger', 'middleware' => $middleware], function() {
    
    Route::get('update-mediator-fee', function() {
        
        $salesOrders = Gelora\Sales\App\SalesOrder\SalesOrderModel::get();
        foreach($salesOrders as $salesOrder) {
            if (!empty($salesOrder->mediator_fee)) {
                $salesOrder->mediator_fee = (int) $salesOrder->mediator_fee;
                $salesOrder->save();
            }
        }
    });

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

    Route::get('update-team', function(Illuminate\Http\Request $request) {

        $salesOrders = \Gelora\Sales\App\SalesOrder\SalesOrderModel::get();
        foreach ($salesOrders as $salesOrder) {
            
            $personnel = Gelora\HumanResource\App\Personnel\PersonnelModel::find($salesOrder->getAttribute('salesPersonnel.id'));
            $team = \Gelora\HumanResource\App\Team\TeamModel::find($personnel->getAttribute('team_id'));

            if ($team) {
                $salesOrder->setAttribute('salesPersonnel.team_id', $team->getAttribute('id'));
                
                $y = ['id','name'];
                
                foreach ($y  as $x) {
                    $teamx[$x] = $team->getAttribute($x);
                }
                
                $teamx['leader'] = [
                    'id' => $team->getAttribute('leader.id'),
                    'name' => $team->getAttribute('leader.name'),
                    'entity_id' => $team->getAttribute('leader.entity_id'),
                    'user_id' => $team->getAttribute('leader.user_id'),
                ];
                
                $salesOrder->setAttribute('salesPersonnel.team', $teamx);
                $salesOrder->save();
            }
        }
    });
});
