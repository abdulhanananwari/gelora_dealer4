<?php

namespace Gelora\PolReg\App\MdSubmissionBatch\Managers\FileGenerators;

use Gelora\PolReg\App\MdSubmissionBatch\MdSubmissionBatchModel;

class SpkId {

    protected $registrationBatch;

    public function __construct(MdSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function fileGenerate() {

        $string = '';

        foreach ($this->registrationBatch->getSalesOrders() as $salesOrder) {
            $string = $string . $salesOrder->id;
            $string = $string . "\n";
        }
        
        return $string;
    }

}
