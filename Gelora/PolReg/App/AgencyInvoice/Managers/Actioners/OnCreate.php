<?php

namespace Gelora\PolReg\App\AgencyInvoice\Managers\Actioners;

use Gelora\PolReg\App\AgencyInvoice\AgencyInvoiceModel;


class OnCreate {
    
    protected $registrationBatch;
    
    public function __construct(AgencyInvoiceModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }
    
    public function action() {
        
        $this->registrationBatch->assignCreator();
        
        $this->registrationBatch->save();   
        return $this->registrationBatch;
    }
}