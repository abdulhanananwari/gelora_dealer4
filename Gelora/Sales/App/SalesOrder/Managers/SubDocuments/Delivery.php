<?php

namespace Gelora\Sales\App\SalesOrder\Managers\SubDocuments;

use Solumax\PhpHelper\App\Mongo\SubDocument;
use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Delivery {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function retrieve() {

        return new SubDocument($this->salesOrder->delivery);
    }

}
