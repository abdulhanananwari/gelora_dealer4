<?php

namespace Gelora\Base\App\SalesExtra\Managers;

use Gelora\Base\App\SalesExtra\SalesExtraModel;
use Solumax\PhpHelper\App\ManagerBase as Manager;

class Assigner extends Manager {

    protected $salesExtra;

    public function __construct(SalesExtraModel $salesExtra) {
        $this->salesExtra = $salesExtra;
    }

    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->salesExtra, __NAMESPACE__, 'Assigners', 'assign');
    }

}
