<?php

namespace Gelora\PolReg\App\Registration\Managers\Actioners;

use Solumax\PhpHelper\App\ManagerBase;
use Gelora\PolReg\App\Registration\RegistrationModel;

class OnCancel extends ManagerBase {
    
    protected $registration;
    
    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }
    
    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->registration,
                __NAMESPACE__, 'OnCancel', 'action');
    }
    
    public function action() {
        
        return $this;
    }
}
