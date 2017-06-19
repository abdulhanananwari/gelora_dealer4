<?php

namespace Gelora\PolReg\App\RegistrationLeasingBpkbSubmissionBatch\Managers\Validators;

use Gelora\PolReg\App\RegistrationLeasingBpkbSubmissionBatch\RegistrationLeasingBpkbSubmissionBatchModel;

class OnClose {

    protected $registrationBatch;

    public function __construct(RegistrationLeasingBpkbSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function validate() {

        if ($this->registrationBatch->handover_at) {
            return ['Batch sudah ditutup tidak dapat diedit lagi'];
        }

        return true;
    }

}
