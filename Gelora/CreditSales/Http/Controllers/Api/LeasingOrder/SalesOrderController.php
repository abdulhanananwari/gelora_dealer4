<?php

namespace Gelora\CreditSales\Http\Controllers\Api\LeasingOrder;

use Gelora\CreditSales\Http\Controllers\Api\LeasingOrderController;
use Illuminate\Http\Request;

class SalesOrderController extends LeasingOrderController {

    protected $leasingOrder;

    public function __construct() {
        parent::__construct();
    }

    public function attach($id, Request $request) {

        $leasingOrder = $this->leasingOrder->find($id);

        $salesOrder = \Gelora\Sales\App\SalesOrder\SalesOrderModel::
                find($request->get('sales_order_id'));

        $validation = $leasingOrder->validate()->onAssignSalesOrder();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $leasingOrder->action()->salesOrder()->attach($salesOrder);

        return $this->formatItem($leasingOrder);
    }

    public function detach($id, Request $request) {

        $leasingOrder = $this->leasingOrder->find($id);

        $validation = $leasingOrder->validate()->onCreateOrUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $leasingOrder->action()->salesOrder()->detach();

        return $this->formatItem($leasingOrder);
    }

}
