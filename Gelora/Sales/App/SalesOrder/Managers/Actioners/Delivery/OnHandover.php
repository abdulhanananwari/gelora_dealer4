<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Delivery;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnHandover {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function action() {
         $this->salesOrder->action()->delivery()->onHandoverSuccessful();      
       /* if ($this->salesOrder['delivery']['status']) {
            
        } else {
            $this->salesOrder->action()->delivery()->onHandoverUnsuccessful();
        }*/
    }
}