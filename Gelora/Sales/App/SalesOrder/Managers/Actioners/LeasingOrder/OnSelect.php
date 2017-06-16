<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnSelect {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function action($leasingOrder) {
        
        $this->salesOrder->leasing_order_id = $leasingOrder->id;
        $this->salesOrder->assignEntityData('leasing_order_selector');
        
        $this->salesOrder->save();
    }
}
