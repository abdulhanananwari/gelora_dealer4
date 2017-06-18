<?php

namespace Gelora\PolReg\App\RegistrationAgencySubmissionBatch\Managers\Actioners;

use Gelora\PolReg\App\RegistrationAgencySubmissionBatch\RegistrationAgencySubmissionBatchModel;

class OnHandover {

    protected $registrationBatch;

    public function __construct(RegistrationAgencySubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function action() {

        $this->registrationBatch->handover_at = \Carbon\Carbon::now();
        $this->registrationBatch->assignEntityData('handover');
        $this->registrationBatch->save();

        return $this->registrationBatch;
    }

}
