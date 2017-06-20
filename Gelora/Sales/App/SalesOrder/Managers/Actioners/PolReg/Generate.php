<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\PolReg;

use Solumax\PhpHelper\App\ManagerBase as Manager;
use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Generate extends Manager {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function action() {
        return $this;
    }
    
    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->salesOrder, __NAMESPACE__, 'Generators', 'generate');
    }
}
