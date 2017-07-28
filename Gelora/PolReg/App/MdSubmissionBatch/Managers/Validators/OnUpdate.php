<?php

namespace Gelora\PolReg\App\MdSubmissionBatch\Managers\Validators;

use Gelora\PolReg\App\MdSubmissionBatch\MdSubmissionBatchModel;

class OnUpdate {

    protected $registrationBatch;

    public function __construct(MdSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function validate() {

        if ($this->registrationBatch->closed_at) {
            return ['Tidak dapat merubah batch karena sudah ditutup'];
        }

        return true;
    }

}
