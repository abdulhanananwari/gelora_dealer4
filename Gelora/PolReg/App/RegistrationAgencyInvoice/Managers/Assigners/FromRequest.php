<?php

namespace Gelora\PolReg\App\RegistrationAgencyInvoice\Managers\Assigners;

use Gelora\PolReg\App\RegistrationAgencyInvoice\RegistrationAgencyInvoiceModel;


class FromRequest {
    
    protected $registrationBatch;
    
    public function __construct(RegistrationAgencyInvoiceModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $this->registrationBatch->fill($request->only('agent', 'file_uuid'));
        
        return $this->registrationBatch;
    }
}