<?php

namespace Gelora\Sales\Http\Controllers\Api\SalesOrder;

use Gelora\Sales\Http\Controllers\Api\SalesOrderController;
use Illuminate\Http\Request;

class PolRegController extends SalesOrderController {

    protected $salesOrder;

    public function __construct() {
        parent::__construct();
    }
    
    public function update($id, Request $request) {
        
        $salesOrder = $this->salesOrder->find($id);
        $salesOrder->assign()->specific()->polReg($request);
        
//        $validation = $salesOrder->validate()->registration()->onUpdate();
//        if ($validation !== true) {
//            return $this->formatErrors($validation);
//        }

        $salesOrder->action()->onUpdate();

        return $this->formatItem($salesOrder);

    }
    
    public function generateStrings($id, Request $request) {
        
        $salesOrder = $this->salesOrder->find($id);

        $validation = $salesOrder->validate()->polReg()->onGenerateStrings();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $salesOrder->action()->polReg()->onGenerateStrings();

        return $this->formatItem($salesOrder);
    }
    
    public function addBatch($id, Request $request) {
        
        $salesOrder = $this->salesOrder->find($id);

        $validation = $salesOrder->validate()->polReg()->onAssignBatch($request->get('batch'));
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $salesOrder->action()->polReg()->onAssignBatch($request->get('batch'));

        return $this->formatItem($salesOrder);
    }
    public function removeBatch($id, Request $request) {
        
        $salesOrder = $this->salesOrder->find($id);
        
        $validation = $salesOrder->validate()->polReg()->onRemoveBatch($request->get('batch'));
        if ($validation !== true ) {
            return $this->formatErrors($validation);
        }
        $salesOrder->action()->polReg()->onRemoveBatch($request->get('batch'));
        return $this->formatItem($salesOrder);

    }

}
