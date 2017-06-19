<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\Delivery;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnScan {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate($unit) {
        
        if ($this->salesOrder->unit_id != $unit->id) {
            return ['Unit yang di scan tidak sama'];
        }
        
        return true;
    }

}
