<?php

namespace Gelora\InventoryManagement\App\MovementOrder\Managers;

use Gelora\InventoryManagement\App\MovementOrder\MovementOrderModel;
use Solumax\PhpHelper\App\ManagerBase as Manager;

class Validator extends Manager {
    
    protected $movementOrder;
    
    public function __construct(MovementOrderModel $movementOrder) {
        $this->movementOrder = $movementOrder;
    }
    
    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->movementOrder,
                __NAMESPACE__, 'Validators', 'validate');
    }
}
