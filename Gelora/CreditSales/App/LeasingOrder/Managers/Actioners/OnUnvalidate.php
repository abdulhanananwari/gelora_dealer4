<?php

namespace Gelora\CreditSales\App\LeasingOrder\Managers\Actioners;

use Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel;

class OnUnvalidate {
    
    protected $leasingOrder;
    
    public function __construct(LeasingOrderModel $leasingOrder) {
        $this->leasingOrder = $leasingOrder;
    }
    
    public function action() {
        
        $this->leasingOrder->validated_at = null;
        $this->leasingOrder->assignEntityData('unvalidator');
        
        $this->leasingOrder->save();
    }
}
