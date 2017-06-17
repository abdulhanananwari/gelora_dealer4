<?php

namespace Gelora\Sales\Http\Controllers\Api\SalesOrder;

use Gelora\Sales\Http\Controllers\Api\SalesOrderController;
use Illuminate\Http\Request;

class DeliveryController  extends SalesOrderController {

    protected $salesOrder;

    public function __construct() {
        parent::__construct();
    }
    
    public function generate($id, Request $request) {
        
        $salesOrder = $this->salesOrder->find($id);
        $unit = \Gelora\Base\App\Unit\UnitModel::
                find($request->get('unit_id'));

//        $validation = $salesOrder->validate()->leasingOrder()->onSelect($leasingOrder);
//        if ($validation !== true) {
//            return $this->formatErrors($validation);
//        }

        $salesOrder->action()->delivery()->onGenerate($unit);
        $salesOrder->action()->unit()->onSelect($unit);

        return $this->formatItem($salesOrder);
        
    }
    public function handover($id, Request $request) {
        
        $salesOrder = $this->salesOrder->find($id);
        
        $salesOrder->assign()->delivery()->onHandover($request);
        
        $salesOrder->action()->delivery()->onHandover();
        
        return $this->formatItem($salesOrder);
        
    }

}
