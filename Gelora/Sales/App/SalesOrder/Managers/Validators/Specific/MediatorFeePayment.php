<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\Specific;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class MediatorFeePayment {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {

        if ($this->salesOrder->getAttribute('mediator.payment.creator.timestamp')) {
            return ['Pembayaran mediator sudah dibuat sebelumnya'];
        }

        if (!$this->salesOrder->getAttribute('mediator.payment.transaction.id')) {
            return ['Transaksi tidak tersimpan'];
        }

        return true;
    }

}
