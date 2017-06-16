<?php

namespace Gelora\CreditSales\App\LeasingOrder\Managers\Retrievers;

use Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel;

class StatusText {

    protected $leasingOrder;

    public function __construct(LeasingOrderModel $leasingOrder) {
        $this->leasingOrder = $leasingOrder;
    }

    public function retrieve() {

        $status = '';

        if ($this->leasingOrder->validated_at) {
            $status = $status . 'Valid.' . "\n";
        }

        if ($this->leasingOrder->po_file_uuid) {
            $status = $status . 'PO diterima.' . "\n";
        } else if ($this->leasingOrder->memo_file_uuid) {
            $status = $status . 'Memo diterima.' . "\n";
        }

        return $status;
    }

}
