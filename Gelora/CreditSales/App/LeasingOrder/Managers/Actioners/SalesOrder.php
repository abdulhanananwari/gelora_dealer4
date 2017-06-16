<?php

namespace Gelora\CreditSales\App\LeasingOrder\Managers\Actioners;

use Solumax\PhpHelper\App\ManagerBase as Manager;
use Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel;

class SalesOrder extends Manager {
    
    protected $leasingOrder;
    
    public function __construct(LeasingOrderModel $leasingOrder) {
        $this->leasingOrder = $leasingOrder;
    }
    
    public function action() {
        return $this;
    }
    
    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->leasingOrder,
                __NAMESPACE__, 'SalesOrder', 'action');
    }
}
