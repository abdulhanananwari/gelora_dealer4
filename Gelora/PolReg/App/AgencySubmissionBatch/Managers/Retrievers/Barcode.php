<?php

namespace Gelora\PolReg\App\AgencySubmissionBatch\Managers\Retrievers;

use Gelora\PolReg\App\AgencySubmissionBatch\AgencySubmissionBatchModel;

class Barcode {

    protected $registrationBatch;

    public function __construct(AgencySubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function retrieve() {

        return \Solumax\PhpHelper\Helpers\Code128::link($this->registrationBatch->id);
    }

}
