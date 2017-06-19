<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Cddb;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnUpdate {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function action() {
    	
        
        $this->salesOrder->save();
    }
}
