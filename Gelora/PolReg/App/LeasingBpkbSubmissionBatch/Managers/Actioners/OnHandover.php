<?php

namespace Gelora\PolReg\App\LeasingBpkbSubmissionBatch\Managers\Actioners;

use Gelora\PolReg\App\LeasingBpkbSubmissionBatch\LeasingBpkbSubmissionBatchModel;

class OnHandover {

    protected $registrationBatch;

    public function __construct(LeasingBpkbSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function action() {

        $this->registrationBatch->handover_at = \Carbon\Carbon::now();
        $this->registrationBatch->assignEntityData('handover');
        $this->registrationBatch->save();

        return $this->registrationBatch;
    }

}
