<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\Financial;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnMediatorFeePayment {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {
        
        return true;
    }
}
