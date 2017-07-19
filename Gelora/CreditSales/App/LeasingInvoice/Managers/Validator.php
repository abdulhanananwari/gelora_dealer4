<?php

namespace Gelora\CreditSales\App\LeasingInvoice\Managers;

use Solumax\PhpHelper\App\ManagerBase as Manager;
use Gelora\CreditSales\App\LeasingInvoice\LeasingInvoiceModel;

class Validator extends Manager {

    protected $leasingInvoice;

    public function __construct(LeasingInvoiceModel $leasingInvoice) {
        $this->leasingInvoice = $leasingInvoice;
    }

    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->leasingInvoice,
                __NAMESPACE__, 'Validators', 'validate');
    }

}
