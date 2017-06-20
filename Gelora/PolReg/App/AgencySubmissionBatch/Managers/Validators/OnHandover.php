<?php

namespace Gelora\PolReg\App\AgencySubmissionBatch\Managers\Validators;

use Gelora\PolReg\App\AgencySubmissionBatch\AgencySubmissionBatchModel;

class OnHandover {

    protected $registrationBatch;

    public function __construct(AgencySubmissionBatchModel $registrationBatch) {
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
