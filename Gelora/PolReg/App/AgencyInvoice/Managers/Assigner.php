<?php

namespace Gelora\PolReg\App\AgencyInvoice\Managers;

use Solumax\PhpHelper\App\ManagerBase as Manager;
use Gelora\PolReg\App\AgencyInvoice\AgencyInvoiceModel;

class Assigner extends Manager {

    protected $registrationAgencyInvoice;

    public function __construct(AgencyInvoiceModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->registrationBatch, __NAMESPACE__, 'Assigners', 'assign');
    }

}
