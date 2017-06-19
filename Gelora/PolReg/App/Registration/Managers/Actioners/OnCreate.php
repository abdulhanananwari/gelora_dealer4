<?php

namespace Gelora\PolReg\App\Registration\Managers\Actioners;

use Gelora\PolReg\App\Registration\RegistrationModel;

class OnCreate {

    protected $registration;

    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }

    public function action() {

        $cddb = $this->registration->salesOrder->cddb;
        $this->registration->cddb_id = $cddb->id;

        $this->registration->save();
        $this->registration->saveId();
    }

}
