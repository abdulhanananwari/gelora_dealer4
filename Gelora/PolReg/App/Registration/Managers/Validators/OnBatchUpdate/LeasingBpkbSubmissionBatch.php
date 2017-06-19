<?php

namespace Gelora\PolReg\App\Registration\Managers\Validators\OnBatchUpdate;

use Gelora\PolReg\App\Registration\RegistrationModel;

class LeasingBpkbSubmissionBatch {
   
    protected $registration;
    
    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }
    
    public function validate() {
        
        if ($this->registration->registrationLeasingBpkbSubmissionBatch->closed_at) {
            return ['Batch penyerahan BPKB ke leasing sudah ditutup tidak dapat dirubah lagi'];
        }
        if ($this->registration->registrationLeasingBpkbSubmissionBatch['mainLeasing']['name'] != $this->registration->delivery->salesOrder->selectedLeasingOrder['mainLeasing']['name']) {
            return ['Leasing yang di pilih tidak sama dengan leasing di SPK '];
        }
        return true;
    }
}
