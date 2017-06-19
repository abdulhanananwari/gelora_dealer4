<?php

namespace Gelora\PolReg\App\Registration\Managers\Assigners;

use Gelora\PolReg\App\Registration\RegistrationModel;

class FromDelivery {
    
    protected $registration;
    
    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }
    
    public function assign($delivery) {
        
        $this->registration->delivery_id = $delivery->id;
        $this->registration->sales_order_id = $delivery->sales_order_id;
        
        return $this->registration;
    }
}
