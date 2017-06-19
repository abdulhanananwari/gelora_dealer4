<?php

namespace Gelora\PolReg\App\RegistrationAgencyInvoice\Managers\Actioners;

use Gelora\PolReg\App\RegistrationAgencyInvoice\RegistrationAgencyInvoiceModel;


class OnCreate {
    
    protected $registrationBatch;
    
    public function __construct(RegistrationAgencyInvoiceModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }
    
    public function action() {
        
        $this->registrationBatch->assignCreator();
        
        $this->registrationBatch->save();        
        $this->registrationBatch->saveId();
        return $this->registrationBatch;
    }
}