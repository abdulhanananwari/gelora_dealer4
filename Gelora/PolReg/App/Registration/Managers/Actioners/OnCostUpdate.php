<?php

namespace Gelora\PolReg\App\Registration\Managers\Actioners;

use Gelora\PolReg\App\Registration\RegistrationModel;

class OnCostUpdate {
    
    protected $registration;
    
    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
        $this->salesOrderExtra = new \Gelora\Sales\App\SalesOrderExtra\SalesOrderExtraModel;
    }
    
    public function action($cost) {

    	if ($cost['charge_to_customer'] == true) {

            $salesOrderExtra = $this->salesOrderExtra->assign()->fromRegistrationCost($this->registration, $cost);
    		$salesOrderExtra->calculate()->total();
    		$salesOrderExtra->save();

            $cost['sales_order_extra_id'] = $salesOrderExtra->id;
    	}

        $costs = (array) $this->registration->costs;
        $costs[$cost['name']] = $cost;
        $this->registration->costs = $costs; 

        $this->registration->save();
    }
}
