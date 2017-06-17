<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners\Specific;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Cddb {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function assign($cddb) {

        $this->salesOrder->cddb = $cddb;

        return $this->salesOrder;
    }
}
