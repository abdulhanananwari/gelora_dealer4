<?php

namespace Gelora\PolReg\App\AgencyInvoice\Managers\Calculators;

use Gelora\PolReg\App\AgencyInvoice\AgencyInvoiceModel;

class Balances {

    protected $registrationBatch;

    public function __construct(AgencyInvoiceModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function calculate() {
        
    }

}
