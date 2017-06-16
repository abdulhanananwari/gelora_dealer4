<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnCreate {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function action() {
        
        $this->salesOrder->assignEntityData('creator');
        $this->salesOrder->save();
        $this->salesOrder->saveId();
    }
}