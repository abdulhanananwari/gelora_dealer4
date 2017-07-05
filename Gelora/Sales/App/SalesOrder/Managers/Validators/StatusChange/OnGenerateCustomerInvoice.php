<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\StatusChange;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnGenerateCustomerInvoice {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate($invoiceAmount) {

        $balance = $this->calculateBalance();
        if ($balance !== true && $invoiceAmount > $balance) {
            return ['Jumlah Tagihan Ke Customer Melibihi Sisa Tagihan. Sisa Tagihan Customer Rp. ' . number_format($balance)];
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
