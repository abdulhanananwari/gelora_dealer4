<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Delivery;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnHandoverUnsuccessful {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function action() {
       $unit = $this->salesOrder->unit;
       $unit->current_status = 'UNRECEIVED';
       $unit->current_location_id = null;

       $unit->save();
       $this->salesOrder->save();
       
    }
}