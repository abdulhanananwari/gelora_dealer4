<?php

namespace Gelora\Sales\App\CancelledSalesOrder\Managers\Actioners;

use Gelora\Sales\App\CancelledSalesOrder\CancelledSalesOrderModel;

class OnCreate {
    
    protected $cancelledSalesOrder;
    
    public function __construct(CancelledSalesOrderModel $cancelledSalesOrder) {
        $this->cancelledSalesOrder = $cancelledSalesOrder;
    }
    
    public function action() {
        
        $this->cancelledSalesOrder->assignEntityData('creator');
  
        $this->cancelledSalesOrder->save();
        
        $this->cancelledSalesOrder->usedSalesOrder
        ->action()->onCancelSalesOrder();
    }
}
