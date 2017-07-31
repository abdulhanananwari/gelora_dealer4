<?php

namespace Gelora\PolReg\App\MdSubmissionBatch\Managers\FileGenerators;

use Gelora\PolReg\App\MdSubmissionBatch\MdSubmissionBatchModel;

class Cddb {

    protected $registrationBatch;

    public function __construct(MdSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function fileGenerate() {

        $string = '';

        foreach ($this->registrationBatch->getSalesOrders() as $salesOrder) {
            $string = $string . $salesOrder->subDocument()->polReg()->strings['cddb']['string'];
            $string = $string . "\n";
        }
        
        return $string;
    }

}
