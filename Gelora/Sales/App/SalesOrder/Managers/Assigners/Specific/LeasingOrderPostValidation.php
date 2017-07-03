<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners\Specific;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class LeasingOrderPostValidation {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $leasingOrder = $this->salesOrder->subDocument()->leasingOrder();
        
        $leasingOrder->fill([
            'customer' => $request->get('customer'),
            'registration' => $request->get('registration'),
            'po_number' => $request->get('po_number'),
            'po_file_uuid' => $request->get('po_file_uuid'),
            'note' => $request->get('note'),
        ]);

        $this->salesOrder->leasingOrder = $leasingOrder;
        
        return $this->salesOrder;
    }
}
