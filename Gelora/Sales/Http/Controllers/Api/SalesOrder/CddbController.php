<?php

namespace Gelora\Sales\Http\Controllers\Api\SalesOrder;

use Gelora\Sales\Http\Controllers\Api\SalesOrderController;
use Illuminate\Http\Request;

class CddbController extends SalesOrderController {

    protected $salesOrder;

    public function __construct() {
        parent::__construct();
    }

    public function update($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);
        $salesOrder->assign()->specific()->cddb($request->get('cddb'));

        $validation = $salesOrder->validate()->cddb()->onUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $salesOrder->action()->cddb()->onUpdate();

        return $this->formatItem($salesOrder);
    }
}
