<?php

namespace Gelora\PolReg\App\RegistrationMdSubmissionBatch\Managers\Actioners;

use Gelora\PolReg\App\RegistrationMdSubmissionBatch\RegistrationMdSubmissionBatchModel;

class OnCreate {
    
    protected $registrationBatch;
    
    public function __construct(RegistrationMdSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }
    
    public function action() {
        
        $this->registrationBatch->assignEntityData('creator');
        
        $this->registrationBatch->save();
        $this->registrationBatch->saveId();
        
        return $this->registrationBatch;
    }
}
