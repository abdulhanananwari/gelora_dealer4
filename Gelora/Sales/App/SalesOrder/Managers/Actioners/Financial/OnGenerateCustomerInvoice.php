<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Financial;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

use MongoDB\BSON\UTCDateTime;

class OnGenerateCustomerInvoice {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action(\Illuminate\Http\Request $request) {
        
        $customerInvoice =  [
            'creator' => $this->salesOrder->assignEntityData(),
            'created_at' => new UTCDateTime(\Carbon\Carbon::now()->timestamp * 1000),
            'total_due' => $this->salesOrder->calculate()->salesOrderBalance()['payment_unreceived'],
            'amount' => (int) $request->get('amount'),
            'note' => $request->get('note'),
            'delegate' => [
                'name' => $request->get('delegate_name'),
                'type' => $request->get('delegate_type'),
            ],
        ];
                
        $this->salesOrder->customerInvoice = $customerInvoice;

        $this->salesOrder->save();
    }

}
