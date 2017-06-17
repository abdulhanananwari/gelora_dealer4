<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Unit;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnSelect {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function action($unit) {
        
        $this->salesOrder->unit_id = $unit->id;
        $this->salesOrder->save();

        $unit->current_status = 'SOLD_IN_PROGRESS';
        $unit->save();  
      
    }
}