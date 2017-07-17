<?php

namespace Gelora\Sales\App\SalesOrderExtra\Managers\Assigners;

use Gelora\Sales\App\SalesOrderExtra\SalesOrderExtraModel;

class FromRequest {
    
    protected $salesOrderExtra;
    
    public function __construct(SalesOrderExtraModel $salesOrderExtra) {
        $this->salesOrderExtra = $salesOrderExtra;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $this->salesOrderExtra->fill($request->only(
                'sales_order_id','sales_program_id','sales_extra_id',
                'type', 'item_name', 'item_code',
                'price_per_unit', 'quantity', 'vat', 'total',
                'pending_handover'));
        
        return $this->salesOrderExtra;
    }
}
