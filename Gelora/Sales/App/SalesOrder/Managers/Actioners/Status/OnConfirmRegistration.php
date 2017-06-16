<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Registration;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnConfirmRegistration {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function action($registration) {
        
        $this->salesOrder->registration_id = $registration->id;
        $this->salesOrder->save();
    }
}