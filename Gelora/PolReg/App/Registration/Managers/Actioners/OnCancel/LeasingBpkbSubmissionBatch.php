<?php

namespace Gelora\PolReg\App\Registration\Managers\Actioners\OnCancel;

use Gelora\PolReg\App\Registration\RegistrationModel;

class LeasingBpkbSubmissionBatch {

    protected $registration;

    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }

    public function action() {
        
     $this->registration->registration_leasing_bpkb_submission_batch_id = null;
     $this->registration->save();
    }

}
