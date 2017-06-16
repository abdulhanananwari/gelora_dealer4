<?php

namespace Gelora\CreditSales\App\LeasingOrder\Managers\Validators;

use Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel;

class OnAssignLeasingProgram {

    protected $leasingOrder;

    public function __construct(LeasingOrderModel $leasingOrder) {
        $this->leasingOrder = $leasingOrder;
    }

    public function validate() {
        
    }
}
