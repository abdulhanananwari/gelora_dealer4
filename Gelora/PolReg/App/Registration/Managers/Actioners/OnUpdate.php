<?php

namespace Gelora\PolReg\App\Registration\Managers\Actioners;

use Gelora\PolReg\App\Registration\RegistrationModel;

class OnUpdate {
    
    protected $registration;
    
    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }
    
    public function action() {
        
        $this->registration->save();
       
    }
}
