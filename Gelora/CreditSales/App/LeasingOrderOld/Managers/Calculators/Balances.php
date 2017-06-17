<?php

namespace Gelora\CreditSales\App\LeasingOrder\Managers\Calculators;

use Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel;

class Balances {

    protected $leasingOrder;

    public function __construct(LeasingOrderModel $leasingOrder) {
        $this->leasingOrder = $leasingOrder;
    }

    public function calculate() {

        $this->leasingOrder->leasing_payable = $this->leasingOrder->on_the_road -
                $this->leasingOrder->dp_po;
    }

}
