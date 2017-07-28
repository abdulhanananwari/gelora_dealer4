<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners\Specific;

use Solumax\PhpHelper\App\ManagerBase as Manager;
use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Delivery extends Manager  {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function assign() {      
        return $this;
    }
    
     public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->salesOrder,
                __NAMESPACE__, 'Delivery', 'assign');
    }
}
