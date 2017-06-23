<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\Unit;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnSelect {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate($unit) {

        if ($this->salesOrder->subDocument()->delivery()->handover_at) {
            return ['Unit tidak dapat di rubah karena sudah serah terima'];
        }

        if ($unit->sales_order_id) {
            return ['Unit sudah dipakai di penjualan lain. ID Penjualan: ' . $unit->sales_order_id];
        }

       if ($unit->current_status !== 'IN_STOCK_SELLABLE') {
           return ["Status unit tidak dapat dijual\nStatus sekarang: " . $unit->current_status];
       }

        if (is_null($unit->pdi_at)) {
            return ['Unit belum di PDI'];
        }

        return true;
    }

}
