<?php

namespace Gelora\Base\App\Unit\Managers\Actioners;

use Solumax\PhpHelper\App\ManagerBase as Manager;
use Gelora\Base\App\Unit\UnitModel;

class Delivery extends Manager {

    protected $unit;

    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }
    
    public function action() {
        return $this;
    }
    
    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->unit, __NAMESPACE__, 'Delivery', 'action');
    }

}
