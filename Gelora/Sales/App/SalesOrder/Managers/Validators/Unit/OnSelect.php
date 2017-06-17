<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\Unit;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnSelect {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate($unit) {

        if ($this->salesOrder['delivery']['handover_at']) {
           return ['Unit tidak dapat di rubah karena sudah serah terima'];           
        }
        if ($this->salesOrder->unit_id) {
           return ['SJ ini sudah terdaftar unit lain. Hapus dulu sebelum ganti unit.'];
        }
        if ($unit->current_status !== 'IN_STOCK_SELLABLE') {
            return ['Unit tidak dapat dijual'];
        }
        if (is_null($unit->pdi_at)) {
            return ['Unit belum di PDI'];
        }
        if (!$this->validateUnitUsability($unit)) {
            return ['Unit tidak dapat dijual. Sudah digunakan untuk penjualan lainnya'];
        }
        return true;
    }
    protected function validateUnitUsability($unit) {

        $count = $this->salesOrder
                ->where('unit_id', $unit->id)
                ->where(function($q) {
                    $q->where('status', '==', true)
                        ->orWhereNull('status');
                })
                ->count();
                
        return $count == 0;
    }
}
