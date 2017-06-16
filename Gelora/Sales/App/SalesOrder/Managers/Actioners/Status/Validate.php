<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Status;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Validate {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function action() {
        
        if (is_null($this->salesOrder->locked_at)) {
            $this->salesOrder->action()->status()->lock();
        }
        
        $this->salesOrder->validated_at = \Carbon\Carbon::now();
        $this->salesOrder->assignEntityData('validator');
        
        $this->salesOrder->save();
    }
}
