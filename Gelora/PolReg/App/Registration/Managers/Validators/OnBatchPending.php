<?php

namespace Gelora\PolReg\App\Registration\Managers\Validators;

use Solumax\PhpHelper\App\ManagerBase as Manager;
use Gelora\PolReg\App\Registration\RegistrationModel;

class OnBatchPending extends Manager {
    
    protected $registration;
    
    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }
    
    public function validate() {
        return $this;
    }
    
    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->registration,
                __NAMESPACE__, 'OnBatchPending', 'validate');
    }
}
