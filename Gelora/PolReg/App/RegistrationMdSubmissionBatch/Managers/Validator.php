<?php

namespace Gelora\PolReg\App\RegistrationMdSubmissionBatch\Managers;

use Solumax\PhpHelper\App\ManagerBase as Manager;
use Gelora\PolReg\App\RegistrationMdSubmissionBatch\RegistrationMdSubmissionBatchModel;

class Validator extends Manager {
    
    protected $registrationBatch;
    
    public function __construct(RegistrationMdSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }
    
    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->registrationBatch,
                __NAMESPACE__, 'Validators', 'validate');
    }
}
