<?php

namespace Gelora\Sales\Http\Controllers\Api\SalesOrder;

use Gelora\Sales\Http\Controllers\Api\SalesOrderController;
use Illuminate\Http\Request;

class LeasingOrderController extends SalesOrderController {

    protected $salesOrder;

    public function __construct() {
        parent::__construct();
    }

    public function select($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);

        $leasingOrder = \Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel::
                find($request->get('leasing_order_id'));

        $validation = $salesOrder->validate()->leasingOrder()->onSelect($leasingOrder);
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $salesOrder->action()->leasingOrder()->onSelect($leasingOrder);

        return $this->formatItem($salesOrder);
    }

    public function deselect($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);

        $validation = $salesOrder->validate()->leasingOrder()->onDeselect();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $salesOrder->action()->leasingOrder()->onDeselect();

        return $this->formatItem($salesOrder);
    }

}
