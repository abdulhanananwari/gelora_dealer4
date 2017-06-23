<?php

namespace Gelora\PolReg\App\MdSubmissionBatch\Managers\Actioners;

use Gelora\PolReg\App\MdSubmissionBatch\MdSubmissionBatchModel;

class OnCreate {
    
    protected $registrationBatch;
    
    public function __construct(MdSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }
    
    public function action() {
        
        $this->registrationBatch->assignEntityData('creator');
        
        $this->registrationBatch->save();
        
        return $this->registrationBatch;
    }
}
