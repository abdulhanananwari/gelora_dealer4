<?php

namespace Gelora\Sales\Http\Controllers\Api\SalesOrder;

use Gelora\Sales\Http\Controllers\Api\SalesOrderController;
use Illuminate\Http\Request;

class LeasingOrderController extends SalesOrderController {

    protected $salesOrder;

    public function __construct() {
        parent::__construct();
    }

    public function update($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);
        $salesOrder->assign()->specific()->leasingOrder()->update($request->get('leasingOrder'));

        $validation = $salesOrder->validate()->leasingOrder()->onUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $salesOrder->action()->onUpdate();

        return $this->formatItem($salesOrder);
    }

    public function updateAfterValidation($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);
        $salesOrder->assign()->specific()->leasingOrder()->updateAfterValidation($request);

        $validation = $salesOrder->validate()->leasingOrder()->onUpdateAfterValidation();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $salesOrder->action()->onUpdate();

        return $this->formatItem($salesOrder);
    }

    public function assignFromLeasingOrder($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);
        $leasingOrder = \Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel::find($request->get('leasing_order_id'));

        $validation = $salesOrder->validate()->leasingOrder()->onAssignFromLeasingOrder($leasingOrder);
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $salesOrder->action()->leasingOrder()->onAssignFromLeasingOrder($leasingOrder);

        return $this->formatItem($salesOrder);
    }

    public function mainReceivablePayment($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);

        $salesOrder->assign()->specific()->leasingOrder()->paymentReceived($request);

        $validation = $salesOrder->validate()->leasingOrder()->onPaymentReceived();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $salesOrder->action()->leasingOrder()->onPaymentReceived();

        return $this->formatItem($salesOrder);
    }

    public function joinPromoPayment($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);
        $salesOrder->assign()->specific()->leasingOrder()->joinPromoPayment($request->get('joinPromos'), $request->get('transaction'));

        $validation = $salesOrder->validate()->leasingOrder()->onUpdateAfterValidation();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $salesOrder->save();

        return $this->formatItem($salesOrder);
    }

    public function poComplete($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);

        $validation = $salesOrder->validate()->leasingOrder()->onUpdateAfterValidation();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $salesOrder->action()->leasingOrder()->onPoCompleted($request->get('po_complete'));

        return $this->formatItem($salesOrder);
    }

}
