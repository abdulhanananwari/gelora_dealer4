<?php

namespace Gelora\PolReg\App\AgencySubmissionBatch\Managers\Actioners;

use Gelora\PolReg\App\AgencySubmissionBatch\AgencySubmissionBatchModel;

class OnHandover {

    protected $registrationBatch;

    public function __construct(AgencySubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function action() {

        $this->registrationBatch->handover_at = \Carbon\Carbon::now();
        $this->registrationBatch->assignEntityData('handover');
        $this->registrationBatch->save();

        return $this->registrationBatch;
    }

}
