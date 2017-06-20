<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\PolReg;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;
use MongoDB\BSON\ObjectID;

class OnRemoveBatch {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function action($batch) {

      
        $polReg = $this->salesOrder->subDocument()->polReg();

        $key = array_keys($batch)[0];
        unset($polReg->$key);
        $this->salesOrder->polReg = $polReg;
        $this->salesOrder->save();
    }
}
