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
        
        $transactions = $this->salesOrder->calculate()->subBalance()->transaction();
        $receivables = $this->salesOrder->calculate()->subBalance()->receivable();
        $leasingOrder = $this->salesOrder->selectedLeasingOrder;
        
        $leasingPayable = $leasingOrder ? $leasingOrder->leasing_payable : 0;
        $paymentUnreceived = $salesOrderAndExtras['grand_total'] - $leasingPayable -
                ($transactions['total'] + $receivables['total']);
        
        return [
            'details' => [
                'salesOrderAndExtras' => $salesOrderAndExtras,
                'transactions' => $transactions,
                'receivables' => $receivables,
            ],
            'payment_unreceived' => $paymentUnreceived,
        ];
    }
}
