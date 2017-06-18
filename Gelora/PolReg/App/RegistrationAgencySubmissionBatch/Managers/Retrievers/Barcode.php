<?php

namespace Gelora\PolReg\App\RegistrationAgencySubmissionBatch\Managers\Retrievers;

use Gelora\PolReg\App\RegistrationAgencySubmissionBatch\RegistrationAgencySubmissionBatchModel;

class Barcode {

    protected $registrationBatch;

    public function __construct(RegistrationAgencySubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function retrieve() {

        return \Solumax\PhpHelper\Helpers\Code128::link($this->registrationBatch->id);
    }

}
