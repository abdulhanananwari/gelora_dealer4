<?php

namespace Gelora\PolReg\App\RegistrationAgencyInvoice\Managers\Validators;

use Gelora\PolReg\App\RegistrationAgencyInvoice\RegistrationAgencyInvoiceModel;

class OnUpdate {

    protected $registrationBatch;

    public function __construct(RegistrationAgencyInvoiceModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function validate() {
        
        if ($this->registrationBatch->closed_at) {
            return ['Batch sudah di tutup , data tidak dapat di edit lagi'];
        }
        
        return true;
    }
    
    

}
