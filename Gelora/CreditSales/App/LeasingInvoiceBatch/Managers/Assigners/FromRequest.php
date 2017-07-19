<?php

namespace Gelora\CreditSales\App\LeasingInvoiceBatch\Managers\Assigners;

use Gelora\CreditSales\App\LeasingInvoiceBatch\LeasingInvoiceBatchModel;

class FromRequest {

    protected $leasingInvoiceBatch;

    public function __construct(LeasingInvoiceBatchModel $leasingInvoiceBatch) {
        $this->leasingInvoiceBatch = $leasingInvoiceBatch;
    }

    public function assign(\Illuminate\Http\Request $request) {

        $this->leasingInvoiceBatch->fill($request->only('mainLeasing', 'subLeasing'));

        return $this->leasingInvoiceBatch;
    }

}
