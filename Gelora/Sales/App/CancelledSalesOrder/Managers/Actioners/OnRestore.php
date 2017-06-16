<?php

namespace Gelora\Sales\App\CancelledSalesOrder\Managers\Actioners;

use Gelora\Sales\App\CancelledSalesOrder\CancelledSalesOrderModel;
use MongoDB\BSON\ObjectID;

class OnRestore {
    
    protected $cancelledSalesOrder;
    
    public function __construct(CancelledSalesOrderModel $cancelledSalesOrder) {
        $this->cancelledSalesOrder = $cancelledSalesOrder;
    }
    
    public function action() {
        
      $salesOrder = new \Gelora\Sales\App\SalesOrder\SalesOrderModel();

      $salesOrder->fill($this->cancelledSalesOrder->sales_order);

      $salesOrder->_id = new ObjectID($salesOrder->id);

      $salesOrder->save();

      $this->cancelledSalesOrder->delete();
      
    }
}
