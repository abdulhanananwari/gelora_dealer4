<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Financial;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnGenerateCustomerInvoice {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action(\Illuminate\Http\Request $request) {
        
        $pendingInvoice =  [
            'creator' => $this->salesOrder->assignEntityData(),
            'total_due' => $salesOrder->calculate()->salesOrderBalance()['payment_unreceived'],
            'amount' => $request->get('amount'),
            'delegate' => [
                'name' => $request->get('delegate_name'),
                'type' => $request->get('delegate_type'),
            ],
        ];
                
        $this->salesOrder->pending_invoice = $pendingInvoice;

        $this->salesOrder->save();
    }

}
