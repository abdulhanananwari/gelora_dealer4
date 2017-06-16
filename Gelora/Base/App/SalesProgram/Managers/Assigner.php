<?php

namespace Gelora\Base\App\SalesProgram\Managers;

use Gelora\Base\App\SalesProgram\SalesProgramModel;
use Solumax\PhpHelper\App\ManagerBase as Manager;

class Assigner extends Manager {
    
    protected $salesProgram;
    
    public function __construct(SalesProgramModel $salesProgram) {
        $this->salesProgram = $salesProgram;
    }
    
    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->salesProgram,
                __NAMESPACE__, 'Assigners', 'assign');
    }
}
