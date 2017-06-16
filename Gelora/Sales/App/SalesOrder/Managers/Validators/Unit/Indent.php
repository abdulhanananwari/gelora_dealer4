<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\Unit;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Indent {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate($leasingOrder) {
        
       if ($this->salesOrder->delivery['unit_id']) {
           return ['unit sedang dalam proses penjualan'];
       }
        
        return true;
    }
}
