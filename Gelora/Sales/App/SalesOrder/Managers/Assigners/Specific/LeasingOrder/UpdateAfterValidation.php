<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners\Specific\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class UpdateAfterValidation {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function assign(\Illuminate\Http\Request $request) {

        // Copy dulu data JP
        $joinPromos = $this->salesOrder->getAttribute('leasingOrder.joinPromos');

        $fillables = $request->only('customer', 'registration', 'application_number', 'po_number', 'po_file_uuid', 'leasing_invoice_batch_id', 'note', 'po_date');

        foreach ($fillables as $key => $value) {
            if (!empty($value)) {
                $this->salesOrder->setAttribute('leasingOrder.' . $key, $value);
            }
        }

        // Kalau user ga punya akses liat JP, balikin data JP dengan yang lama
        if (!\SolAuthClient::hasAccess('VIEW_LEASING_ORDER_JOIN_PROMOS')) {
            $this->reassignJoinPromos($joinPromos);
        }

        return $this->salesOrder;
    }

    protected function reassignJoinPromos($joinPromos) {

        $this->salesOrder->setAttribute('leasingOrder.joinPromos', $joinPromos);
    }

}
