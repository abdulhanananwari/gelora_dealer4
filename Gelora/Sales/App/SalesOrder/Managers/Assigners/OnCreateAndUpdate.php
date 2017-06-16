<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnCreateAndUpdate {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $keys = [
            'customer',
            'registration',
            'vehicle',
            'mediator',
            'salesPersonnel',
            'sales_note', 'files', 'sales_condition', 'payment_type',
            'plafond','discount', 'mediator_fee'
        ];
        
        $this->salesOrder->fill($request->only($keys));
        
        return $this->salesOrder;
    }
}
