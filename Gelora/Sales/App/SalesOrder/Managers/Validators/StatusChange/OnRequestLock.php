
<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\StatusChange;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnRequestLock {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function validate() {
        
        return true;
    }
}
