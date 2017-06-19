<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Delivery;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnHandover {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action() {

        $this->salesOrder->unit->action()->delivery()->onHandover();
        
        $this->salesOrder->delivery->handover->created_at = \Carbon\Carbon::now();
        
        $this->salesOrder->save();
    }

}
