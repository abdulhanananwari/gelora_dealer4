<?php

namespace Gelora\PolReg\App\LeasingBpkbSubmissionBatch\Managers\Retrievers;

use Gelora\PolReg\App\LeasingBpkbSubmissionBatch\LeasingBpkbSubmissionBatchModel;

class Barcode {

    protected $registrationBatch;

    public function __construct(LeasingBpkbSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function retrieve() {

        return \Solumax\PhpHelper\Helpers\Code128::link($this->registrationBatch->id);
    }

}
