<?php

namespace Gelora\PolReg\App\RegistrationAgencyInvoice\Managers\Actioners;

use Gelora\PolReg\App\RegistrationAgencyInvoice\RegistrationAgencyInvoiceModel;

class OnClose {

    protected $registrationBatch;

    public function __construct(RegistrationAgencyInvoiceModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function action() {

        $this->registrationBatch->closed_at = \Carbon\Carbon::now();
        $this->registrationBatch->assignEntityData('closer');

        $this->registrationBatch->save();
        return $this->registrationBatch;
    }

}
