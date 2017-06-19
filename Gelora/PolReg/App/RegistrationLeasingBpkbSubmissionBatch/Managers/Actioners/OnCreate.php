<?php

namespace Gelora\PolReg\App\RegistrationLeasingBpkbSubmissionBatch\Managers\Actioners;

use Gelora\PolReg\App\RegistrationLeasingBpkbSubmissionBatch\RegistrationLeasingBpkbSubmissionBatchModel;

class OnCreate {

    protected $registrationBatch;

    public function __construct(RegistrationLeasingBpkbSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function action() {

        $this->registrationBatch->assignEntityData('creator');
        
        $this->registrationBatch->save();
        $this->registrationBatch->saveId();
        return $this->registrationBatch;
    }

}
