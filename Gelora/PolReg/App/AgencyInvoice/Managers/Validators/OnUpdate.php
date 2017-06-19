<?php

namespace Gelora\PolReg\App\AgencyInvoice\Managers\Validators;

use Gelora\PolReg\App\AgencyInvoice\AgencyInvoiceModel;

class OnUpdate {

    protected $registrationBatch;

    public function __construct(AgencyInvoiceModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function validate() {
        
        if ($this->registrationBatch->closed_at) {
            return ['Batch sudah di tutup , data tidak dapat di edit lagi'];
        }
        
        return true;
    }
    
    

}
