<?php

namespace Gelora\PolReg\App\Registration\Managers\Validators;

use Gelora\PolReg\App\Registration\RegistrationModel;

class OnUpdate {
    
    protected $registration;
    
    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }
    
    public function validate() {
        
        if ($this->registration->closed_at) {
            return ['Data faktur sudah dikonfirmasi dan tidak dapat diedit lagi'];
        }
        
        return true;
    }
}
