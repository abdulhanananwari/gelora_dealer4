<?php

namespace Gelora\PolReg\App\RegistrationAgencySubmissionBatch\Managers\Actioners;

use Gelora\PolReg\App\RegistrationAgencySubmissionBatch\RegistrationAgencySubmissionBatchModel;

class OnClose {

    protected $registrationBatch;

    public function __construct(RegistrationAgencySubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function action() {

        $this->registrationBatch->closed_at = \Carbon\Carbon::now();
        $this->registrationBatch->assignEntityData('closer');
        $this->registrationBatch->save();

        return $this->registrationBatch;
    }

}
