<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnAssignFromLeasingOrder {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function action($leasingOrder) {
        
        $this->salesOrder->leasingOrder = $leasingOrder->toArray();
        
        $leasingOrder->action()->onAssignToSalesOrder();
        
        $this->salesOrder->save();
    }
}
