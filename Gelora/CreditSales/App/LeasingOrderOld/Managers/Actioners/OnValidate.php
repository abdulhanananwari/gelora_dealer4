<?php

namespace Gelora\CreditSales\App\LeasingOrder\Managers\Actioners;

use Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel;

class OnValidate {
    
    protected $leasingOrder;
    
    public function __construct(LeasingOrderModel $leasingOrder) {
        $this->leasingOrder = $leasingOrder;
    }
    
    public function action() {
        
        $this->leasingOrder->validated_at = \Carbon\Carbon::now();
        
        $this->leasingOrder->assignEntityData('validator');
        
        $this->leasingOrder->save();
    }
}
