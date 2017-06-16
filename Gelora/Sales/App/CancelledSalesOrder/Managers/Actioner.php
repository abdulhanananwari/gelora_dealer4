<?php

namespace Gelora\Sales\App\CancelledSalesOrder\Managers;

use Solumax\PhpHelper\App\ManagerBase as Manager;
use Gelora\Sales\App\CancelledSalesOrder\CancelledSalesOrderModel;

class Actioner extends Manager {
    
    protected $cancelledSalesOrder;
    
    public function __construct(CancelledSalesOrderModel $cancelledSalesOrder) {
        $this->cancelledSalesOrder = $cancelledSalesOrder;
    }
    
    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->cancelledSalesOrder,
                __NAMESPACE__, 'Actioners', 'action');
    }
}
