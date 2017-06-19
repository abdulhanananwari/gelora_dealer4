<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators;

use Solumax\PhpHelper\App\ManagerBase as Manager;
use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class PolReg extends Manager {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->salesOrder, __NAMESPACE__, 'PolReg', 'validate');
    }

    public function validate() {
        return $this;
    }

}
