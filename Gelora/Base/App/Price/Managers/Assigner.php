<?php

namespace Gelora\Base\App\Price\Managers;

use Gelora\Base\App\Price\PriceModel;
use Solumax\PhpHelper\App\ManagerBase as Manager;

class Assigner extends Manager {
    
    protected $price;
    
    public function __construct(PriceModel $price) {
        $this->price = $price;
    }
    
    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->price,
                __NAMESPACE__, 'Assigners', 'assign');
    }
}
