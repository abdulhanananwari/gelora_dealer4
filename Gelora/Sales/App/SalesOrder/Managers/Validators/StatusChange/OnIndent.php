<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\StatusChange;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnIndent {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {

        if (request()->get('bypass_balance_validation') != 'true') {
            $balance = $this->calculateBalance();
            if ($balance !== true && $balance < 0) {
                return [
                        [
                        'text' => 'Masih ada kurang bayar Rp ' . number_format($balance) . '. Yakin lanjutkan?',
                        'type' => 'confirm',
                        'if_confirmed' => 'bypass_balance_validation'
                    ]
                ];
            }
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
