<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class FromProspect {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function assign(\Gelora\Sales\App\Prospect\ProspectModel $prospect) {
        
        $keys = [
            'customer',
            'registration',
            'vehicle',
            'mediator',
            'salesPersonnel',
            'sales_note', 
            'sales_condition', 'payment_type',
            'discount', 'mediator_fee'
        ];
        
        foreach ($keys as $key) {
            $this->salesOrder->$key = $prospect->$key;
        }
        
        return $this->salesOrder;
    }
}
