<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Calculators;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class SalesOrderBalance {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function calculate() {

        $salesOrderAndExtras = $this->salesOrder->calculate()->subBalance()->salesOrderAndExtras();
        $balance = $salesOrderAndExtras['grand_total'];

        // If credit, subtract PO
        if ($this->salesOrder->payment_type == 'credit') {
            
            $leasingOrder = $this->salesOrder->subDocument()->leasingOrder();
            $leasingPayable = $leasingOrder->on_the_road - $leasingOrder->dp_po;
            
            $balance = $balance - $leasingPayable;
        }

        // Subtract payments made
        $transactions = $this->salesOrder->calculate()->subBalance()->transaction();
        $paymentUnreceived = $balance - $transactions['total'];

        return [
            'details' => [
                'salesOrderAndExtras' => $salesOrderAndExtras,
                'transactions' => $transactions,
            ],
            'grand_total' => $balance,
            'payment_unreceived' => $paymentUnreceived,
        ];
    }

}
