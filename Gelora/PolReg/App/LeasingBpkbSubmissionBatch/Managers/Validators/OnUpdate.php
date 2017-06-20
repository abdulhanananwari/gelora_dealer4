<?php

namespace Gelora\PolReg\App\LeasingBpkbSubmissionBatch\Managers\Validators;

use Gelora\PolReg\App\LeasingBpkbSubmissionBatch\LeasingBpkbSubmissionBatchModel;

class OnUpdate {

    protected $registrationBatch;

    public function __construct(LeasingBpkbSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function validate() {

        if ($this->registrationBatch->handover_at) {
            return ['Batch sudah ditutup tidak dapat diedit lagi'];
        }

        return true;
    }

}
