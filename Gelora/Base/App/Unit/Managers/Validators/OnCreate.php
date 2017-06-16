<?php

namespace Gelora\Base\App\Unit\Managers\Validators;

use Solumax\PhpHelper\App\ManagerBase as Manager;
use Gelora\Base\App\Unit\UnitModel;

class OnCreate extends Manager {

    protected $unit;

    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }

    public function validate() {
        return $this;
    }

    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->unit,
                __NAMESPACE__, 'OnCreate', 'validate');
    }

}
