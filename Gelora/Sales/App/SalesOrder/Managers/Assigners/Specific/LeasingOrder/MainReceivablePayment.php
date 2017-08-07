<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners\Specific\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class MainReceivablePayment {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function assign(\Illuminate\Http\Request $request) {

        $this->salesOrder->setAttribute('leasingOrder.payment_transaction_uuid', $request->get('payment_transaction_uuid'));

        if ($request->get('payment_at')) {
            $paymentAt = \Carbon\Carbon::createFromFormat('Y-m-d', $request->get('payment_at'));
        } else {
            $paymentAt = \Carbon\Carbon::now();
        }
        $this->salesOrder->setAttribute('leasingOrder.payment_at', $paymentAt);
        
        if ($request->has('transaction')) {
            $this->salesOrder->setAttribute('leasingOrder.paymentTransaction', [
                'id' => $request->input('transaction.id'),
                'uuid' => $request->input('transaction.uuid'),
                'amount' => (int) $request->input('transaction.amount'),
                'creator' => $this->salesOrder->assignEntityData(),
            ]);
        }

        return $this->salesOrder;
    }

}
