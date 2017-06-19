<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\PolReg;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;
use MongoDB\BSON\ObjectID;

class OnAssignBatch {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function action($batch) {
        
//        exit(json_encode($batch));
        
        $polReg = $this->salesOrder->subDocument()->polReg();
        $key = array_keys($batch)[0];
        $polReg->$key = new ObjectID($batch[$key]);
        
        $this->salesOrder->polReg = $polReg;
        $this->salesOrder->save();
    }
}
