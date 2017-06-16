<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Calculators;

use Solumax\PhpHelper\App\ManagerBase as Manager;
use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class SubBalance extends Manager {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function calculate() {
        return $this;
    }
    
    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->salesOrder,
                __NAMESPACE__, 'SubBalances', 'calculate');
    }
}
