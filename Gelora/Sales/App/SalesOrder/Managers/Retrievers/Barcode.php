<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Retrievers;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Barcode {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function retrieve() {

        return \Solumax\PhpHelper\Helpers\Code128::link($this->salesOrder->id);
    }

}
