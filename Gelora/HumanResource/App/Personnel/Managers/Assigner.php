<?php

namespace Gelora\HumanResource\App\Personnel\Managers;

use Solumax\PhpHelper\App\ManagerBase as Manager;

use Gelora\HumanResource\App\Personnel\PersonnelModel;

class Assigner extends Manager {
    
    protected $personnel;
    
    public function __construct(PersonnelModel $personnel) {
        $this->personnel = $personnel;
    }
    
    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->personnel,
                __NAMESPACE__, 'Assigners', 'assign');
    }
}
