<?php

namespace Gelora\PolReg\App\MdSubmissionBatch\Managers;

use Solumax\PhpHelper\App\ManagerBase as Manager;
use Gelora\PolReg\App\MdSubmissionBatch\MdSubmissionBatchModel;

class Retriever extends Manager {
    
    protected $registrationBatch;
    
    public function __construct(MdSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }
    
    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->registrationBatch,
                __NAMESPACE__, 'Retrievers', 'retrieve');
    }
}
