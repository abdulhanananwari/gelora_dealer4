<?php

namespace Gelora\PolReg\App\Registration\Managers\Actioners\OnCancel;

use Gelora\PolReg\App\Registration\RegistrationModel;

class PendingLeasingBpkbSubmissionBatch {

    protected $registration;

    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }

    public function action() {
        
    	$this->registration->unset('pending_leasing_bpkb_submission_batch'); 

    	$this->registration->save();
     
    }

}
