<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners\Specific\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class UpdateAfterValidation {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function assign(\Illuminate\Http\Request $request) {

        $fillables = $request->only('mainLeasing','subLeasing',
            'customer', 'registration', 'application_number',
            'po_number', 'po_file_uuid', 'leasing_invoice_batch_id', 'note', 'po_date');

        foreach ($fillables as $key => $value) {
            if (!empty($value)) {
                $this->salesOrder->setAttribute('leasingOrder.' . $key, $value);
            }
        }

        return $this->salesOrder;
    }
}
