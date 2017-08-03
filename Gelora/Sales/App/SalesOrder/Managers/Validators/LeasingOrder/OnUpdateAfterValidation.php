<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnUpdateAfterValidation {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {

        if ($this->salesOrder->financial_closed_at) {
            return ['PO tidak dapat di edit karena status financial SPK sudah ditutup'];
        }

        if ($this->salesOrder->getAttribute('leasingOrder.payment_at') && !is_array($this->salesOrder->getAttribute('leasingOrder.joinPromos'))) {
            return ['PO tidak bisa dirubah karena pembayaran PO sudah dibuat'];
        }

        return true;
    }

}
