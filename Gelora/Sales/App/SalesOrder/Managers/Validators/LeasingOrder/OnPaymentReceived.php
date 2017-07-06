<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnPaymentReceived {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {
        
        if ($this->salesOrder->getAttribute('leasingOrder.payment_at')) {
            return ['Pembayaran sudah diinput sebelumnya'];
        }

        return true;
    }

}
