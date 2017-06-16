<?php

namespace Gelora\InventoryManagement\App\MovementOrderDetail\Managers;

use Gelora\InventoryManagement\App\MovementOrderDetail\MovementOrderDetailModel;
use Solumax\PhpHelper\App\ManagerBase as Manager;

class Assigner extends Manager {
    
    protected $movementOrderDetail;
    
    public function __construct(MovementOrderDetailModel $movementOrderDetail) {
        $this->movementOrderDetail = $movementOrderDetail;
    }
    
    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->movementOrderDetail,
                __NAMESPACE__, 'Assigners', 'assign');
    }
}
