<?php

namespace Gelora\PolReg\App\Registration\Managers\Validators\OnBatchUpdate;

use Gelora\PolReg\App\Registration\RegistrationModel;

class AgencyInvoice {
   
    protected $registration;
    
    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }
    
    public function validate() {
        
        if ($this->registration->registrationAgencyInvoice->closed_at) {
            return ['Batch tagihan dari Biro Jasa sudah ditutup tidak dapat dirubah lagi'];
        }
        
        return true;
    }
}
