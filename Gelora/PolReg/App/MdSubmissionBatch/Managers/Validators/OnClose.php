<?php

namespace Gelora\PolReg\App\MdSubmissionBatch\Managers\Validators;

use Gelora\PolReg\App\MdSubmissionBatch\MdSubmissionBatchModel;

class OnClose {

    protected $registrationBatch;

    public function __construct(MdSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function validate() {

        $registrationsValidation = $this->validates();
        if ($registrationsValidation !== true) {
            return $registrationsValidation;
        }

        return true;
    }

    protected function validates() {

        foreach ($this->registrationBatch->registrations as $registration) {

            if (is_null($registration->cddb_id)) {
                return ['CDDB ada yg belum diassign'];
            }
        }

        return true;
    }

}
