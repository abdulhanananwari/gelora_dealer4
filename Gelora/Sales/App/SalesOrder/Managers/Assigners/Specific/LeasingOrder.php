<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners\Specific;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class LeasingOrder {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function assign($leasingOrder) {

        $this->salesOrder->leasingOrder = $leasingOrder;

        return $this->salesOrder;
    }
}
