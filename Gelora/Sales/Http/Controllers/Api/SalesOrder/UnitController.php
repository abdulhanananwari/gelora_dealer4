<?php

namespace Gelora\Sales\Http\Controllers\Api\SalesOrder;

use Gelora\Sales\Http\Controllers\Api\SalesOrderController;
use Illuminate\Http\Request;

class UnitController extends SalesOrderController {

    protected $salesOrder;

    public function __construct() {
        parent::__construct();
    }

    public function indent($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);

        $validation = $salesOrder->validate()->unit()->indent($salesOrder);
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }
        
        $salesOrder->action()->unit()->indent();

        return $this->formatItem($salesOrder);
    }

}
