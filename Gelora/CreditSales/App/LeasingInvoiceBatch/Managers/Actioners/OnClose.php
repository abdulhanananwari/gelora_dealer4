<?php

namespace Gelora\CreditSales\App\LeasingInvoiceBatch\Managers\Actioners;

use Gelora\CreditSales\App\LeasingInvoiceBatch\LeasingInvoiceBatchModel;

class OnClose {

    protected $leasingInvoiceBatch;

    public function __construct(LeasingInvoiceBatchModel $leasingInvoiceBatch) {
        $this->leasingInvoiceBatch = $leasingInvoiceBatch;
    }

    public function action() {

        $this->leasingInvoiceBatch->closed_at = \Carbon\Carbon::now();
        $this->leasingInvoiceBatch->assignEntityData('closer');

        $this->leasingInvoiceBatch->save();

        return $this->leasingInvoiceBatch;
    }

}
