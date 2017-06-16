<?php

namespace Gelora\CreditSales\App\LeasingOrder\Managers\Assigners;

use Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel;

class SalesOrder {
    
    protected $leasingOrder;
    
    public function __construct(LeasingOrderModel $leasingOrder) {
        $this->leasingOrder = $leasingOrder;
    }
    
    public function assign($salesOrder) {
       
        $this->leasingOrder->sales_order_id = $salesOrder->id;
        $this->leasingOrder->save();
    }
}
