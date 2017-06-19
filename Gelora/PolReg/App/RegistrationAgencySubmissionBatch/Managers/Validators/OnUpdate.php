<?php

namespace Gelora\PolReg\App\RegistrationAgencySubmissionBatch\Managers\Validators;

use Gelora\PolReg\App\RegistrationAgencySubmissionBatch\RegistrationAgencySubmissionBatchModel;

class OnUpdate {

    protected $registrationBatch;

    public function __construct(RegistrationAgencySubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function validate() {

        if ($this->registrationBatch->handover_at) {
            return ['Faktur sudah diserahkan kepada Biro Jasa / Sedang Dalam proses'];
        }

        return true;
    }

}
