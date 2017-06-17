<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Delivery;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnHandoverSuccessful {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function action() {
        
        \DB::transaction(function(){
            
            $this->salesOrder->assignEntityData('delivery_assigner');
         
            $this->salesOrder->save();
        });
    }
}