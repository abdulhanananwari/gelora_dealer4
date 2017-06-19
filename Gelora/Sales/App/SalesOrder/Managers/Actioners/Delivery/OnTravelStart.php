<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Delivery;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnTravelStart {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action() {
        
        $delivery = $this->salesOrder->subDocument()->delivery();
        $delivery->travel_starter = $this->salesOrder->assignEntityData();
        $this->salesOrder->delivery = $delivery;
        $this->salesOrder->save();
    }

}
