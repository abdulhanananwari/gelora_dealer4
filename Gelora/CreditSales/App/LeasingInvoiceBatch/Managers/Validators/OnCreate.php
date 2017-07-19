<?php

namespace Gelora\CreditSales\App\LeasingInvoiceBatch\Managers\validators;

use Gelora\CreditSales\App\LeasingInvoiceBatch\LeasingInvoiceBatchModel;

class OnCreate {

    protected $leasingInvoiceBatch;

    public function __construct(LeasingInvoiceBatchModel $leasingInvoiceBatch) {
        $this->leasingInvoiceBatch = $leasingInvoiceBatch;
    }

    public function validate() {

        return true;
    }

}
