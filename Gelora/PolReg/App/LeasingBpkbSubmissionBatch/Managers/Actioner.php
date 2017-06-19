<?php

namespace Gelora\PolReg\App\LeasingBpkbSubmissionBatch\Managers;

use Solumax\PhpHelper\App\ManagerBase as Manager;
use Gelora\PolReg\App\LeasingBpkbSubmissionBatch\LeasingBpkbSubmissionBatchModel;

class Actioner extends Manager {
    
    protected $registrationBatch;
    
    public function __construct(LeasingBpkbSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }
    
    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->registrationBatch,
                __NAMESPACE__, 'Actioners', 'action');
    }
}
