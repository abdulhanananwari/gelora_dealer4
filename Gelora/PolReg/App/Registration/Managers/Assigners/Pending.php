<?php

namespace Gelora\PolReg\App\Registration\Managers\Assigners;

use Solumax\PhpHelper\App\ManagerBase as Manager;
use Gelora\PolReg\App\Registration\RegistrationModel;

class Pending extends Manager {
    
    protected $registration;
    
    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }
    
    public function assign() {
        return $this;
    }
    
    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->registration,
                __NAMESPACE__, 'Pending', 'assign');
    }
}
