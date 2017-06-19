<?php

namespace Gelora\PolReg\App\AgencyInvoice\Managers\Assigners;

use Gelora\PolReg\App\AgencyInvoice\AgencyInvoiceModel;


class FromRequest {
    
    protected $registrationBatch;
    
    public function __construct(AgencyInvoiceModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $this->registrationBatch->fill($request->only('agent', 'file_uuid'));
        
        return $this->registrationBatch;
    }
}