<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnUpdate {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {

       if ($this->salesOrder->subDocument()->leasingOrder()->payment_at) {
           return ['PO sudah tidak dapat di edit'];
       }

        return true;
    }

}
