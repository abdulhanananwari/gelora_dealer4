<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Delivery;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnSuccessful {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function action($deliveryId) {
        
        $this->salesOrder->delivery_id = $deliveryId;
        $this->salesOrder->assignEntityData('delivery_assigner');
        
        $this->salesOrder->save();
    }
}