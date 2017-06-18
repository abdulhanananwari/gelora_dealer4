<?php

namespace Gelora\PolReg\App\Registration\Managers\Actioners\OnCancel;

use Gelora\PolReg\App\Registration\RegistrationModel;

class PendingAgencySubmissionBatch {

    protected $registration;

    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }

    public function action() {
        
     //unset($this->registration->pending_agency_submission_batch);
  	 $this->registration->unset('pending_agency_submission_batch');
  	 
     $this->registration->save();
     
    }

}
