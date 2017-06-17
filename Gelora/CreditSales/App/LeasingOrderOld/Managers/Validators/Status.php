<?php

namespace Gelora\CreditSales\App\LeasingOrder\Managers\Validators;

use Solumax\PhpHelper\App\ManagerBase as Manager;
use Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel;

class Status extends Manager {

    protected $leasingOrder;

    public function __construct(LeasingOrderModel $leasingOrder) {
        $this->leasingOrder = $leasingOrder;
    }

    public function validate() {
        return $this;
    }

    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->leasingOrder,
                __NAMESPACE__, 'Status', 'validate');
    }
}
