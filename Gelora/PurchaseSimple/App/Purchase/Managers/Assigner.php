<?php

namespace Gelora\PurchaseSimple\App\Purchase\Managers;

use Solumax\PhpHelper\App\ManagerBase as Manager;
use Gelora\PurchaseSimple\App\Purchase\PurchaseModel;

class Assigner extends Manager {
    
    protected $purchase;
    
    public function __construct(PurchaseModel $purchase) {
        $this->purchase = $purchase;
    }
    
    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->purchase,
                __NAMESPACE__, 'Assigners', 'assign');
    }
}
