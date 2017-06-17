<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Delivery;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnScan {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action() {

        $this->salesOrder->scanned = true;
        $this->salesOrder->save();
    }

}
