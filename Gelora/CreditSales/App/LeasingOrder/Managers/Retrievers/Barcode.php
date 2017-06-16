<?php

namespace Gelora\CreditSales\App\LeasingOrder\Managers\Retrievers;

use Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel;

class Barcode {

    protected $leasingOrder;

    public function __construct(LeasingOrderModel $leasingOrder) {
        $this->leasingOrder = $leasingOrder;
    }

    public function retrieve() {

        return \Solumax\PhpHelper\Helpers\Code128::link($this->leasingOrder->id);
    }

}
