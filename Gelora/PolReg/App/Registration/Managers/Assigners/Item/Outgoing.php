<?php

namespace Gelora\PolReg\App\Registration\Managers\Assigners\Item;

use Gelora\PolReg\App\Registration\RegistrationModel;

class Outgoing {
    
    protected $registration;
    
    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }
    
    public function assign($name, $outgoing) {
        
        $items = $this->registration->items;
        
        // update $incoming
        $outgoing['user'] = [
            'name' => \ParsedJwt::getByKey('name'),
            'user_id' => \ParsedJwt::getByKey('sub'),
        ];
        $outgoing['timestamp'] = \Carbon\Carbon::now()->timestamp;
        
        $item = $items[$name];
        $item['outgoing'] = $outgoing;
        
        $items[$name] = $item;
        
        $this->registration->items = $items;
        return $this->registration;
    }
}
