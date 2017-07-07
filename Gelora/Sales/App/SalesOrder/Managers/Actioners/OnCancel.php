<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnCancel {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action() {

        $this->salesOrder->delete();
    }

}
