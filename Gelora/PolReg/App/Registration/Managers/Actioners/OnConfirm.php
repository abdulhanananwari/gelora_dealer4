<?php

namespace Gelora\PolReg\App\Registration\Managers\Actioners;

use Gelora\PolReg\App\Registration\RegistrationModel;

class OnConfirm {

    protected $registration;

    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }

    public function action($status) {

        $this->registration->registration_md_submission_batch_confirmed = $status;
        $this->registration->registration_md_submission_batch_confirmed_at = \Carbon\Carbon::now();
        $this->registration->assignEntityData('registration_md_submission_batch_confirmer');

        $this->registration->salesOrder->action()->registration()->onConfirmRegistration($this->registration);
        $this->registration->delivery->action()->registration()->onConfirmRegistration($this->registration);

        $this->registration->save();
    }

}
