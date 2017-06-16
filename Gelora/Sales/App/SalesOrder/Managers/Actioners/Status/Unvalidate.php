<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Status;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Unvalidate {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function action() {
        
        $this->salesOrder->validated_at = null;
        $this->salesOrder->assignEntityData('unvalidator');
        
        $this->salesOrder->save();
    }
}
