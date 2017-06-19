<?php

namespace Gelora\PolReg\App\MdSubmissionBatch\Managers\FileGenerators;

use Gelora\PolReg\App\MdSubmissionBatch\MdSubmissionBatchModel;

class Udstk {

    protected $registrationBatch;

    public function __construct(MdSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function fileGenerate() {


        $registrations = $this->registrationBatch->registrations;

        $file = tmpfile();

        foreach ($this->registrationBatch->getSalesOrders() as $salesOrder) {
            fwrite($file, $salesOrder->subDocument()->polReg()->strings['udstk']['string']);
            fwrite($file, "\n");
        }

        fseek($file, 0);
        return $file;
    }

}
