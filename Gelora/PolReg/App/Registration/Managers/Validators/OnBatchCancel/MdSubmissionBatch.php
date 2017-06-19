<?php

namespace Gelora\PolReg\App\Registration\Managers\Validators\OnBatchCancel;

use Gelora\PolReg\App\Registration\RegistrationModel;

class MdSubmissionBatch {
	
	protected $registration;
    
    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }

    public function validate() {

    	if ($this->registration->registration_md_submission_batch_confirmed_at) {
    		return ['Batch tidak dapat dibatalkan karena faktur sudah dikonfirmasi'];
    	}
        
    	return true;
    }
}