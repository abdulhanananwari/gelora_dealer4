<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Unit;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnDeselect {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function action() {
        
        $unit = $this->salesOrder->unit;
      
        $unit->current_status = 'IN_STOCK_SELLABLE';
        $unit->save();

        $this->salesOrder->unit_id = null;
        $this->salesOrder->save();
        
    }
}