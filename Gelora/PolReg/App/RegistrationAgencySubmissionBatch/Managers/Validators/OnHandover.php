<?php

namespace Gelora\PolReg\App\RegistrationAgencySubmissionBatch\Managers\Validators;

use Gelora\PolReg\App\RegistrationAgencySubmissionBatch\RegistrationAgencySubmissionBatchModel;

class OnHandover {

    protected $registrationBatch;

    public function __construct(RegistrationAgencySubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function validate() {

        if (!$this->registrationBatch->closed_at) {
            return ['Batch harus ditutup dulu'];
        }

        if ($this->registrationBatch->handover_at) {
            return ['Batch sudah diserahkan kepada Biro Jasa'];
        }

        return true;
    }

}
