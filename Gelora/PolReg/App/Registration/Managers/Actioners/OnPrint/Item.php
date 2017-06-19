<?php

namespace Gelora\PolReg\App\Registration\Managers\Actioners\OnPrint;

use Gelora\PolReg\App\Registration\RegistrationModel;

class Item {

    protected $registration;

    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }

    public function action($itemName) {
        
        $items = $this->registration->items;
        $item = $items[$itemName];

        $item['last_printed_at'] = \Carbon\Carbon::now()->toDateTimeString();
        $item['printed_count'] = isset($item['printed_count']) ? $item['printed_count'] + 1 : 1;

        $items[$itemName] = $item;
        $this->registration->items = $items;

        $this->registration->save();
        
        return $item;
    }

}
