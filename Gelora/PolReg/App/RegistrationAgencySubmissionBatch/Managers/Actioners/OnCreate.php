<?php

namespace Gelora\PolReg\App\RegistrationAgencySubmissionBatch\Managers\Actioners;

use Gelora\PolReg\App\RegistrationAgencySubmissionBatch\RegistrationAgencySubmissionBatchModel;

class OnCreate {

    protected $registrationBatch;

    public function __construct(RegistrationAgencySubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function action() {

        $this->registrationBatch->assignCreator();

        $this->registrationBatch->save();        
        $this->registrationBatch->saveId();
        
        return $this->registrationBatch;
    }

}
