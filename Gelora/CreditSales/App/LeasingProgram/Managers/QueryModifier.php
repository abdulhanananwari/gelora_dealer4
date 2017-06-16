<?php

namespace Gelora\CreditSales\App\LeasingProgram\Managers;

use Gelora\CreditSales\App\LeasingProgram\LeasingProgramModel;
use Solumax\PhpHelper\App\ManagerBase as Manager;

class QueryModifier extends Manager {
    
    protected $leasingProgram;
    
    public function __construct(LeasingProgramModel $leasingProgram) {
        $this->leasingProgram = $leasingProgram;
    }
    
    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->leasingProgram,
                __NAMESPACE__, 'QueryModifiers', 'queryModify');
    }
}
