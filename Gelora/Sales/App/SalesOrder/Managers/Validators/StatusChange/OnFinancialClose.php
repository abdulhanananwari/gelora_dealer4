<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\StatusChange;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnFinancialClose {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {

        if (empty($this->salesOrder->subDocument()->leasingOrder()->get('payment_at'))) {
            return ['Leasing Belum Membayar Pokok Hutang'];
        }
        $balance = $this->calculateBalance();
        if ($balance !== true) {
            return ['SPK belum bisa di tutup karena kustomer masih mempunyai hutang Rp ' . number_format($balance)];
        }
        $costs = $this->salesOrder->subDocument()->polReg()->get('costs.' .  );
        if ($costs < 0 ) {
                return ['Pol Reg costs belum di input'];
        }

        if (empty($this->salesOrder->subDocument()->polReg()->get('generator'))) {
            return ['Data Pol Reg belum digenerate'];
        }
        
        if (empty($this->salesOrder->subDocument()->polReg()->get('agency_invoice_id'))) {
            return ['Batch invoice biro jasa belum diassign'];
        }
        
        return true;
    }

    protected function calculateBalance() {

        $balance = $this->salesOrder->calculate()->SalesOrderBalance()['payment_unreceived'];
        if ($balance == 0) {
            return true;
        } else {
            return $balance;
        }
    }

}
