<?php

namespace Gelora\PolReg\App\Registration\Managers\Validators\OnBatchUpdate;

use Gelora\PolReg\App\Registration\RegistrationModel;

class MdSubmissionBatch {
   
    protected $registration;
    
    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }
    
    public function validate() {
        
        if ($this->registration->registration_md_submission_batch_confirmed_at) {
            return ['Faktur sudah dikonfirmasi tidak bisa diedit lagi'];
        }
        
        if ($this->registration->registrationMdSubmissionBatch->closed_at) {
            return ['Batch faktur ke MD sudah di tutup'];
        }
        
        return true;
    }
}
