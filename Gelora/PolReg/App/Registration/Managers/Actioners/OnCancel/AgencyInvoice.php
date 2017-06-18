<?php

namespace Gelora\PolReg\App\Registration\Managers\Actioners\OnCancel;

use Gelora\PolReg\App\Registration\RegistrationModel;

class AgencyInvoice {

    protected $registration;

    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }

    public function action() {
        
     $this->registration->registration_agency_invoice_id = null;
     $this->registration->save();
    }

}
