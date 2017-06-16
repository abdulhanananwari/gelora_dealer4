<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnCreate {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function validate() {
        
        $standardValidation = $this->salesOrder->validate()->onUpdate();
        if ($standardValidation !== true) {
            return $standardValidation;
        }
        
        return true;
    }
}