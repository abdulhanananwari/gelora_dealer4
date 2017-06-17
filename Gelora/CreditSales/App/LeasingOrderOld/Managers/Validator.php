<?php

namespace Gelora\CreditSales\App\LeasingOrder\Managers;

use Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel;
use Solumax\PhpHelper\App\ManagerBase as Manager;

class Validator extends Manager {
    
    protected $leasingOrder;
    
    public function __construct(LeasingOrderModel $leasingOrder) {
        $this->leasingOrder = $leasingOrder;
    }
    
    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->leasingOrder,
                __NAMESPACE__, 'Validators', 'validate');
    }
}
