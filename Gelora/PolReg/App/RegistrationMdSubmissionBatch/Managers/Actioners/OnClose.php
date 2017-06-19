<?php

namespace Gelora\PolReg\App\RegistrationMdSubmissionBatch\Managers\Actioners;

use Gelora\PolReg\App\RegistrationMdSubmissionBatch\RegistrationMdSubmissionBatchModel;

class OnClose {
    
    protected $registrationBatch;
    
    public function __construct(RegistrationMdSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }
    
    public function action() {
        
        $this->registrationBatch->closed_at = \Carbon\Carbon::now();
        $this->registrationBatch->assignEntityData('closer');
        
        $this->registrationBatch->save();
        
        return $this->registrationBatch;
    }
}
