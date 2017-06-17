<?php

namespace Gelora\CreditSales\App\LeasingOrder\Managers\Validators;

use Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel;

class OnAssignSalesOrder {

    protected $leasingOrder;

    public function __construct(LeasingOrderModel $leasingOrder) {
        $this->leasingOrder = $leasingOrder;
    }

    public function validate() {

        if ($this->leasingOrder->sales_order_id) {
            return ['PO ini sudah digunakan di SPK'];
        }

        return true;
    }

}
