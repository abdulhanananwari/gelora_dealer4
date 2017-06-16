<?php

namespace Gelora\CreditSales\App\Leasing\Managers;

use Gelora\CreditSales\App\Leasing\LeasingModel;
use Solumax\PhpHelper\App\ManagerBase as Manager;

class Assigner extends Manager {
    
    protected $leasing;
    
    public function __construct(LeasingModel $leasing) {
        $this->leasing = $leasing;
    }
    
    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->leasing,
                __NAMESPACE__, 'Assigners', 'assign');
    }
}
