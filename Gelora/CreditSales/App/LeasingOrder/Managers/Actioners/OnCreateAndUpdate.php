<?php

namespace Gelora\CreditSales\App\LeasingOrder\Managers\Actioners;

use Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel;

class OnCreateAndUpdate {
    
    protected $leasingOrder;
    
    public function __construct(LeasingOrderModel $leasingOrder) {
        $this->leasingOrder = $leasingOrder;
    }
    
    public function action() {
        
        $this->leasingOrder->save();
    }
}
