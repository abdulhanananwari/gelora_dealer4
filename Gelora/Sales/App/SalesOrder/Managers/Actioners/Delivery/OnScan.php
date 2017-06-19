<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Delivery;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnScan {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action() {
        
        $delivery = $this->salesOrder->subDocument()->delivery();
        $delivery->scanner = $this->salesOrder->assignEntityData();
        $this->salesOrder->delivery = $delivery;
        $this->salesOrder->save();
    }

}
