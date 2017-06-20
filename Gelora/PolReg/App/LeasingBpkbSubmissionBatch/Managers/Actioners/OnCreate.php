<?php

namespace Gelora\PolReg\App\LeasingBpkbSubmissionBatch\Managers\Actioners;

use Gelora\PolReg\App\LeasingBpkbSubmissionBatch\LeasingBpkbSubmissionBatchModel;

class OnCreate {

    protected $registrationBatch;

    public function __construct(LeasingBpkbSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function action() {

        $this->registrationBatch->assignEntityData('creator');
        
        $this->registrationBatch->save();
        $this->registrationBatch->saveId();
        return $this->registrationBatch;
    }

}
