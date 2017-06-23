<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Delivery;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnCancel {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action() {
        
        $this->processUnit($this->salesOrder->unit);

        $this->salesOrder->unset('unit');
        $this->salesOrder->unset('delivery');
        
        $this->salesOrder->save();
    }
    
    protected function processUnit($unit) {

        $unit->action()->delivery()->onDeselect();
    }

}
