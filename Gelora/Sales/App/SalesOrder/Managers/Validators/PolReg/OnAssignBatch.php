<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\PolReg;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnAssignBatch {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function validate($batch) {
        return true;
        
        $polReg = $this->salesOrder->subDocument()->polReg();
        $key = array_keys($batch)[0];
        
        if (!empty($polReg->$key)) {
            return [$key . ' sudah di set sebelumnya'];
        }
        
        return true;
    }
}
