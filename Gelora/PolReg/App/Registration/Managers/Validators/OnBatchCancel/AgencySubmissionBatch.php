<?php

namespace Gelora\PolReg\App\Registration\Managers\Validators\OnBatchCancel;

use Gelora\PolReg\App\Registration\RegistrationModel;

class AgencySubmissionBatch {
	
	protected $registration;
    
    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }

    public function validate() {

    	if ($this->registration->registrationAgencySubmissionBatch->closed_at) {
    		return ['Batch tidak dapat dibatalkan karena Batch sudah ditutup'];
    	}
    	return true;
    }
}