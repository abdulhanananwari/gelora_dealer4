<?php

namespace Gelora\CreditSales\App\LeasingProgram\Managers;

use Solumax\PhpHelper\App\ManagerBase as Manager;
use Gelora\CreditSales\App\LeasingProgram\LeasingProgramModel;

class Assigner extends Manager {
    
    protected $leasingProgram;
    
    public function __construct(LeasingProgramModel $leasingProgram) {
        $this->leasingProgram = $leasingProgram;
    }
    
    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->leasingProgram,
                __NAMESPACE__, 'Assigners', 'assign');
    }
}
