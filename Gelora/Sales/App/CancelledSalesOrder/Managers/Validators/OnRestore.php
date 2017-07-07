<?php

namespace Gelora\Sales\App\CancelledSalesOrder\Managers\Validators;

use Gelora\Sales\App\CancelledSalesOrder\CancelledSalesOrderModel;

class OnRestore {

    protected $cancelledSalesOrder;

    public function __construct(CancelledSalesOrderModel $cancelledSalesOrder) {
        $this->cancelledSalesOrder = $cancelledSalesOrder;
    }

    public function validate() {

        if ($this->cancelledSalesOrder->restored_at) {
            return ['Pembatalan sudah direstore sebelumnya'];
        }

        return true;
    }

}
