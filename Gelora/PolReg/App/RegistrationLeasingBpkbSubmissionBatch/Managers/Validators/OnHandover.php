<?php

namespace Gelora\PolReg\App\RegistrationLeasingBpkbSubmissionBatch\Managers\Validators;

use Gelora\PolReg\App\RegistrationLeasingBpkbSubmissionBatch\RegistrationLeasingBpkbSubmissionBatchModel;

class OnHandover {

    protected $registrationBatch;

    public function __construct(RegistrationLeasingBpkbSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function validate() {

        if (!$this->registrationBatch->closed_at) {
            return ['Batch harus ditutup dulu'];
        }

        if ($this->registrationBatch->handover_at) {
            return ['Batch sudah diserahkan kepada Leasing'];
        }

        $attrsValidation = $this->validateAttributes();
        if ($attrsValidation->fails()) {
            return $attrsValidation->errors()->all();
        }

        return true;
    }

    protected function validateAttributes() {

        return \Validator::make($this->registrationBatch->toArray(), [
                    'file_uuid' => 'required',
        ]);
    }

}
