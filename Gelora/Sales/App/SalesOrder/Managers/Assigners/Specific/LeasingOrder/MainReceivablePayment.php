<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners\Specific\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class MainReceivablePayment {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function assign(\Illuminate\Http\Request $request) {

        $leasingOrder = $this->salesOrder->subDocument()->leasingOrder();

        $leasingOrder->fill($request->only('payment_transaction_uuid'));

        if ($request->get('payment_at')) {
            $paymentAt = \Carbon\Carbon::createFromFormat('Y-m-d', $request->get('payment_at'));
        } else {
            $paymentAt = \Carbon\Carbon::now();
        }
        $leasingOrder->setDate('payment_at', $paymentAt);

        $this->salesOrder->leasingOrder = $leasingOrder;

        return $this->salesOrder;
    }

}
