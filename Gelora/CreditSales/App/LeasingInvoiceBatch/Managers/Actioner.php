<?php

namespace Gelora\CreditSales\App\LeasingInvoiceBatch\Managers;

use Gelora\CreditSales\App\LeasingInvoiceBatch\LeasingInvoiceBatchModel;
use Solumax\PhpHelper\App\ManagerBase as Manager;

class Actioner extends Manager {
    
    protected $leasingInvoiceBatch;
    
    public function __construct(LeasingInvoiceBatchModel $leasingInvoiceBatch) {
        $this->leasingInvoiceBatch = $leasingInvoiceBatch;
    }
    
    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->leasingInvoiceBatch,
                __NAMESPACE__, 'Actioners', 'action');
    }
}
