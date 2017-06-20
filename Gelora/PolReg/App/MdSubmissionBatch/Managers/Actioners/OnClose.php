<?php

namespace Gelora\PolReg\App\MdSubmissionBatch\Managers\Actioners;

use Gelora\PolReg\App\MdSubmissionBatch\MdSubmissionBatchModel;

class OnClose {
    
    protected $registrationBatch;
    
    public function __construct(MdSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }
    
    public function action() {
        
        $this->registrationBatch->closed_at = \Carbon\Carbon::now();
        $this->registrationBatch->assignEntityData('closer');
        
        $this->registrationBatch->save();
        
        return $this->registrationBatch;
    }
}
