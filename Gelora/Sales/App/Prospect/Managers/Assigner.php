<?php

namespace Gelora\Sales\App\Prospect\Managers;

use Gelora\Sales\App\Prospect\ProspectModel;
use Solumax\PhpHelper\App\ManagerBase as Manager;

class Assigner extends Manager {
    
    protected $prospect;
    
    public function __construct(ProspectModel $prospect) {
        $this->prospect = $prospect;
    }
    
    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->prospect, __NAMESPACE__, 'Assigners', 'assign');
    }
}
