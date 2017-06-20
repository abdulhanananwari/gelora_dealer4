<?php

namespace Gelora\PolReg\App\AgencySubmissionBatch\Managers\Actioners;

use Gelora\PolReg\App\AgencySubmissionBatch\AgencySubmissionBatchModel;

class OnCreate {

    protected $registrationBatch;

    public function __construct(AgencySubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function action() {

        $this->registrationBatch->assignCreator();

        $this->registrationBatch->save();   
        
        return $this->registrationBatch;
    }

}
