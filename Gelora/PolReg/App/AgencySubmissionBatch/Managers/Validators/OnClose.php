<?php

namespace Gelora\PolReg\App\AgencySubmissionBatch\Managers\Validators;

use Gelora\PolReg\App\AgencySubmissionBatch\AgencySubmissionBatchModel;

class OnClose {

    protected $registrationBatch;

    public function __construct(AgencySubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function validate() {

        $attrsValidation = $this->validateAttributes();
        if ($attrsValidation->fails()) {
            return $attrsValidation->errors()->all();
        }

        return true;
    }

    protected function validateAttributes() {

        return \Validator::make($this->registrationBatch->toArray(), [
                    'agent' => 'required',
        ]);
    }

}
