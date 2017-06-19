<?php

namespace Gelora\PolReg\App\AgencySubmissionBatch\Managers\Validators;

use Gelora\PolReg\App\AgencySubmissionBatch\AgencySubmissionBatchModel;

class OnUpdate {

    protected $registrationBatch;

    public function __construct(AgencySubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function validate() {

        if ($this->registrationBatch->handover_at) {
            return ['Faktur sudah diserahkan kepada Biro Jasa / Sedang Dalam proses'];
        }

        return true;
    }

}
