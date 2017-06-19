<?php

namespace Gelora\PolReg\App\Registration\Managers\Retrievers;

use Gelora\PolReg\App\Registration\RegistrationModel;

class FormattedCosts {

    protected $registration;

    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }

    public function retrieve() {
        
        if (is_null($this->registration->closed_at)) {
            $this->assignCosts();
        }
    }
    
    public function assignCosts() {
        
        $defaultCosts = config('gelora.polReg.defaultCosts');
        $costs = [];
        
        foreach($defaultCosts as $cost) {
            
            if (isset($this->registration->costs[$cost])) {
                
                $costs[$cost] = $this->registration->costs[$cost];
                
            } else {
                
                $costs[$cost] = ['name'=> $cost];
            }
        }
        $this->registration->costs = $costs; 
        // return $costs;
    }

}

                