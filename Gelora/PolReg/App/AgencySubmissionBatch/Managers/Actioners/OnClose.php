<?php

namespace Gelora\PolReg\App\AgencySubmissionBatch\Managers\Actioners;

use Gelora\PolReg\App\AgencySubmissionBatch\AgencySubmissionBatchModel;

class OnClose {

    protected $registrationBatch;

    public function __construct(AgencySubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function action() {

        $this->registrationBatch->closed_at = \Carbon\Carbon::now();
        $this->registrationBatch->assignEntityData('closer');
        $this->registrationBatch->save();

        return $this->registrationBatch;
    }

}
