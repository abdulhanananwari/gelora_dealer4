<?php

namespace Gelora\PolReg\App\Registration\Managers\Validators;

use Gelora\PolReg\App\Registration\RegistrationModel;

class OnConfirmMdSubmissionBatch {

    protected $registration;

    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }

    public function validate() {

        if (!$this->registration->registration_md_submission_batch_id) {
            return ['Batch ke MD belum dipilih'];
        }

        if (!$this->registration->registrationMdSubmissionBatch->closed_at) {
            return ['Batch ke MD belum ditutup'];
        }

        if ($this->registration->registration_agency_submission_batch_id) {
            return ['Faktur sudah di submit ke biro jasa, tdk dapat dirubah lagi'];
        }
        if ($this->registration->registration_md_submission_batch_confirmed_at) {
            return ['Faktur sudah di konfirmasi sebelumnya pada ' . $this->registration->registration_md_submission_batch_confirmed_at->toDateTimeString()];
        }

        if (empty($this->registration->salesOrder->cddb['string'])) {
            return ['Cddb belum generate text'];
        }
        return true;
    }

}
