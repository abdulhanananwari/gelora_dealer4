<?php

namespace Gelora\CreditSales\App\LeasingPersonnel\Managers;

use Gelora\CreditSales\App\LeasingPersonnel\LeasingPersonnelModel;
use Solumax\PhpHelper\App\ManagerBase as Manager;

class Actioner extends Manager {
    
    protected $leasingPersonnel;
    
    public function __construct(LeasingPersonnelModel $leasingPersonnel) {
        $this->leasingPersonnel = $leasingPersonnel;
    }
    
    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->leasingPersonnel,
                __NAMESPACE__, 'Actioners', 'action');
    }
}
