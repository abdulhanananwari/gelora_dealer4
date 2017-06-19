<?php

namespace Gelora\PolReg\App\Registration\Managers\Assigners;

use Gelora\PolReg\App\Registration\RegistrationModel;

class Cost {

    protected $registration;

    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }

    public function assign($cost) {
        
        $cost['charge_to_customer'] = isset($cost['charge_to_customer']) ? (bool) $cost['charge_to_customer'] : false;
        
        $cost['creator'] = [
            'name' => \ParsedJwt::getByKey('name'),
            'user_id' => \ParsedJwt::getByKey('sub'),
        ];

        $cost['timestamp'] = \Carbon\Carbon::now()->timestamp;

        return $cost;
    }

}
