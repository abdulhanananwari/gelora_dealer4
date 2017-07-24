<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners\Specific\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class UpdateAfterValidation {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function assign(\Illuminate\Http\Request $request) {

        $leasingOrder = $this->salesOrder->subDocument()->leasingOrder();

        $leasingOrder->fill([
            'customer' => $request->get('customer'),
            'registration' => $request->get('registration'),
            'po_number' => $request->get('po_number'),
            'po_file_uuid' => $request->get('po_file_uuid'),
            'leasing_invoice_batch_id' => $request->get('leasing_invoice_batch_id'),
            'note' => $request->get('note'),
        ]);

        $this->salesOrder->leasingOrder = $leasingOrder;

        return $this->salesOrder;
    }

}
