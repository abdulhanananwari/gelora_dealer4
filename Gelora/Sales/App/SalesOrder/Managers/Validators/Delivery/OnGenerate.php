<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\Delivery;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnGenerate {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {

        return true;
    }

}
