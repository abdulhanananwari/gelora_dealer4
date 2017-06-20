<?php

namespace Gelora\HumanResource\App\Team\Managers;

use Solumax\PhpHelper\App\ManagerBase as Manager;
use Gelora\HumanResource\App\Team\TeamModel;

class Assigner extends Manager {
    
    protected $team;
    
    public function __construct(TeamModel $team) {
        $this->team = $team;
    }
    
    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->team, 
                __NAMESPACE__, 'Assigners', 'assign');
    }
}
