<?php

namespace Gelora\PolReg\App\Registration\Managers\Retrievers;

use Gelora\PolReg\App\Registration\RegistrationModel;

class FormattedItems {

    protected $registration;

    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }

    public function retrieve() {
        
        if (is_null($this->registration->closed_at)) {
            $this->assignItems();
        }
    }
    
    public function assignItems() {
        
        $defaultItems = config('gelora.polReg.defaultItems');
        $items = [];
        
        foreach($defaultItems as $item) {
            
            if (isset($this->registration->items[$item])) {
                
                $items[$item] = $this->registration->items[$item];
                
            } else {
                
                $items[$item] = [
                    'name' => $item
                ];
            }
        }
        $this->registration->items = $items;
        // return $items;
    }

}
