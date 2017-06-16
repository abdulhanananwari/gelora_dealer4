<?php

namespace Gelora\Base\App\Unit\Managers;

use Solumax\PhpHelper\App\ManagerBase as Manager;
use Gelora\Base\App\Unit\UnitModel;

class Actioner extends Manager {
    
    protected $unit;
    
    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }
    
    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->unit,
                __NAMESPACE__, 'Actioners', 'action');
    }
}
