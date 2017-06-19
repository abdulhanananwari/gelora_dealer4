<?php

namespace Gelora\PolReg\App\Registration\Managers\Validators\OnBatchPending;

use Gelora\PolReg\App\Registration\RegistrationModel;

class LeasingBpkbSubmissionBatch {
	
	protected $registration;
    
    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }

    public function validate() {

        if ($this->registration->registration_leasing_bpkb_submission_batch_id) {
            return ['Batch tidak dapat dipending karena  sudah dipilih'];
        }
        
    	return true;
    }
}