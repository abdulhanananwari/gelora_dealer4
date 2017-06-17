<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Delivery;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

use MongoDB\BSON\UTCDateTime;

class OnGenerate {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function action($unit) {
        
        $delivery = new \stdClass();
        
        $delivery->created_at = new UTCDateTime(\Carbon\Carbon::now()->timestamp * 1000);
        $delivery->creator = $this->salesOrder->assignEntityData();
        
        $this->salesOrder->delivery = $delivery;
        
        $this->salesOrder->unit_id = $unit->id;

        $this->salesOrder->action()->onUpdate();
    }
}