<?php

namespace Gelora\PolReg\App\Registration\Managers\Validators\OnBatchUpdate;

use Gelora\PolReg\App\Registration\RegistrationModel;

class AgencySubmissionBatch {
   
    protected $registration;
    
    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }
    
    public function validate() {
        
        if ($this->registration->registrationAgencySubmissionBatch->closed_at) {
            return ['Batch data ke Biro Jasa sudah ditutup tidak dapat dirubah lagi'];
        }
        
        return true;
    }
}
