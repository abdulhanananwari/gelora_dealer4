<?php

namespace Gelora\CreditSales\App\LeasingOrder\Managers\Validators;

use Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel;

class OnGenerateInvoice {

    protected $leasingOrder;

    public function __construct(LeasingOrderModel $leasingOrder) {
        $this->leasingOrder = $leasingOrder;
    }

    public function validate($generateDue) {
        
        if (empty($this->leasingOrder->salesOrder->delivery)) {
            return ['Pengiriman unit belum dibuat'];
        }

        if ($generateDue && $this->leasingOrder->invoice_generated_at) {
            return ['INVOICE_PRINTED', 'Invoice sudah di cetak sebelumnya'];
        }

        return true;
    }

}
