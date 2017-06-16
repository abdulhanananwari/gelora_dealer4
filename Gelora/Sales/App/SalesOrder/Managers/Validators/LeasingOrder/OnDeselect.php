<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnDeselect {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {
        
        $onUpdateValidation = $this->salesOrder->validate()->onUpdate();
        if ($onUpdateValidation !== true) {
            return $onUpdateValidation;
        }

        return true;
    }
}
