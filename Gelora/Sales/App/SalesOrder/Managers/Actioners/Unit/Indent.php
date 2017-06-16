<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Unit;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Indent {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function action() {
        
      $indent = [
       		'creator' => $this->salesOrder->assignEntityData(),
      ];

      $this->salesOrder->indent = $indent; 
      $this->salesOrder->save();
    }
}