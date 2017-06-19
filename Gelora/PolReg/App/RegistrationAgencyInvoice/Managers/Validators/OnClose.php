<?php

namespace Gelora\PolReg\App\RegistrationAgencyInvoice\Managers\Validators;

use Gelora\PolReg\App\RegistrationAgencyInvoice\RegistrationAgencyInvoiceModel;

class OnClose {

    protected $registrationBatch;

    public function __construct(RegistrationAgencyInvoiceModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function validate() {
        
        $attrsValidation = $this->validateAttributes();
        if ($attrsValidation->fails()) {
            return $attrsValidation->errors()->all();
        }
        
        return true;
    }
    
    protected function validateAttributes() {
        
        return \Validator::make($this->registrationBatch->toArray(), [
            'agent' => 'required',
            'file_uuid' => 'required'
        ]);
    }

}
