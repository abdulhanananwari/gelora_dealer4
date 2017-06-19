<?php

namespace Gelora\PolReg\App\Registration\Managers\Retrievers;

use Gelora\PolReg\App\Registration\RegistrationModel;

class Status {

    protected $registration;

    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }

    public function retrieve() {
        
    }
    
}
