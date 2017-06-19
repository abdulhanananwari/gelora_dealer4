<?php

namespace Gelora\PolReg\App\Registration\Managers\Actioners\OnPrint;

use Gelora\PolReg\App\Registration\RegistrationModel;

class Cost {

    protected $registration;

    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
        $this->salesOrderExtra = new \Gelora\Sales\App\SalesOrderExtra\SalesOrderExtraModel;
    }

    public function action($costName) {
        
        $costs = $this->registration->costs;
        $cost = $costs[$costName];

        $cost['last_printed_at'] = \Carbon\Carbon::now()->toDateTimeString();
        $cost['printed_count'] = isset($cost['printed_count']) ? $cost['printed_count'] + 1 : 1;

        $costs[$costName] = $cost;
        $this->registration->costs = $costs;

        $this->registration->save();
        
        return $cost;
    }

}
