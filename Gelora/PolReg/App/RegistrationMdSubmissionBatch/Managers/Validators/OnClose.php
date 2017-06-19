<?php

namespace Gelora\PolReg\App\RegistrationMdSubmissionBatch\Managers\Validators;

use Gelora\PolReg\App\RegistrationMdSubmissionBatch\RegistrationMdSubmissionBatchModel;

class OnClose {

    protected $registrationBatch;

    public function __construct(RegistrationMdSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function validate() {

        $registrationsValidation = $this->validateRegistrations();
        if ($registrationsValidation !== true) {
            return $registrationsValidation;
        }

        return true;
    }

    protected function validateRegistrations() {

        foreach ($this->registrationBatch->registrations as $registration) {

            if (is_null($registration->cddb_id)) {
                return ['CDDB ada yg belum diassign'];
            }
        }

        return true;
    }

}
