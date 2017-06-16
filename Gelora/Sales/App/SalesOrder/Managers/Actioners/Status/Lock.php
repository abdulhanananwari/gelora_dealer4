<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Status;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Lock {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function action() {
        
        $this->salesOrder->locked_at = \Carbon\Carbon::now();
        $this->salesOrder->assignEntityData('locker');
        
        $this->salesOrder->save();
    }
}