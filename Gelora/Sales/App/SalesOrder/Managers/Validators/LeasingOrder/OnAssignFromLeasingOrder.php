<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;
use Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel;

class OnAssignFromLeasingOrder {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate(LeasingOrderModel $leasingOrder) {

        $onUpdateValidation = $this->salesOrder->validate()->onUpdate();
        if ($onUpdateValidation !== true) {
            return $onUpdateValidation;
        }
        
        $leasingOrderValidation = $leasingOrder->validate()->onAssignToSalesOrder();
        if ($leasingOrderValidation !== true) {
            return $leasingOrderValidation;
        }
        
        return true;
    }
}
