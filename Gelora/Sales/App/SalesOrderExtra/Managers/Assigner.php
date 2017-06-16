<?php

namespace Gelora\Sales\App\SalesOrderExtra\Managers;

use Solumax\PhpHelper\App\ManagerBase as Manager;
use Gelora\Sales\App\SalesOrderExtra\SalesOrderExtraModel;

class Assigner extends Manager {
    
    protected $salesOrderExtra;
    
    public function __construct(SalesOrderExtraModel $salesOrderExtra) {
        $this->salesOrderExtra = $salesOrderExtra;
    }
    
    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->salesOrderExtra,
                __NAMESPACE__, 'Assigners', 'assign');
    }
}
