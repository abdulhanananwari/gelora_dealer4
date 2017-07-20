<?php

namespace Gelora\CreditSales\App\LeasingInvoiceBatch\Managers\validators;

use Gelora\CreditSales\App\LeasingInvoiceBatch\LeasingInvoiceBatchModel;

class OnClose {

    protected $leasingInvoiceBatch;

    public function __construct(LeasingInvoiceBatchModel $leasingInvoiceBatch) {
        $this->leasingInvoiceBatch = $leasingInvoiceBatch;
    }

    public function validate() {

        foreach ($this->leasingInvoiceBatch->getSalesOrders() as $salesOrder) {
                if (is_null((collect($salesOrder->leasingOrder)->get('po_number')))) {
                    return ['Batch tidak dapat ditutup karena masih ada Nomor PO yang kosong'];
                }
            }
        
        return true;
    }

   
}
