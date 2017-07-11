<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnUpdate {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function action() {
        
        \SolLog::write('SalesOrder', $this->salesOrder->id, 'update', $this->salesOrder->toArray());
        
        $this->salesOrder->save();
    }
}