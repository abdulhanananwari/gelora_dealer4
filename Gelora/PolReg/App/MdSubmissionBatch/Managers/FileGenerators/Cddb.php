<?php

namespace Gelora\PolReg\App\MdSubmissionBatch\Managers\FileGenerators;

use Gelora\PolReg\App\MdSubmissionBatch\MdSubmissionBatchModel;

class Cddb {

    protected $registrationBatch;

    public function __construct(MdSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function fileGenerate() {

        $file = tmpfile();

        foreach ($this->registrationBatch->getSalesOrders() as $salesOrder) {
            fwrite($file, $salesOrder->subDocument()->polReg()->strings['cddb']['string']);
            fwrite($file, "\n");
        }

        fseek($file, 0);
        return $file;
    }

}
