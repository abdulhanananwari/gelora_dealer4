<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Retrievers;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Plafond {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function retrieve() {

        return base64_decode($this->salesOrder->plafond, true);
    }

}
