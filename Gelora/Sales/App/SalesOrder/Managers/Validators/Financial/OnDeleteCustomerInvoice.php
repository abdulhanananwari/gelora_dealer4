<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\Financial;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnDeleteCustomerInvoice {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {
        
        $updateValidation = $this->salesOrder->validate()->financial()->onUpdate();
        if ($updateValidation !== true) {
            return $updateValidation;
        }
        
        return true;
    }
}
