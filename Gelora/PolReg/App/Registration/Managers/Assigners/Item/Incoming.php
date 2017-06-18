<?php

namespace Gelora\PolReg\App\Registration\Managers\Assigners\Item;

use Gelora\PolReg\App\Registration\RegistrationModel;

class Incoming {
    
    protected $registration;
    
    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }
    
    public function assign($name, $incoming) {
        
        $items = $this->registration->items;
        
        // Initialize array if items is still empty
        if (!is_array($items)) {
            $items = [];
        }
        
        // update $incoming
        $incoming['user'] = [
            'name' => \ParsedJwt::getByKey('name'),
            'user_id' => \ParsedJwt::getByKey('sub'),
        ];
        $incoming['timestamp'] = \Carbon\Carbon::now()->timestamp;
        
        $items[$name] = [
            'name' => $name,
            'incoming' => $incoming,
        ];
        
        $this->registration->items = $items;
        return $this->registration;
    }
}
