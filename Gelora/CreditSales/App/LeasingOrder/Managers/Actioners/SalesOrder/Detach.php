<?php

namespace Gelora\CreditSales\App\LeasingOrder\Managers\Actioners\SalesOrder;

use Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel;

class Detach {
    
    protected $leasingOrder;
    
    public function __construct(LeasingOrderModel $leasingOrder) {
        $this->leasingOrder = $leasingOrder;
    }
    
    public function action() {
        
        unset($this->leasingOrder->sales_order_id);
        $this->leasingOrder->save();
    }
}
