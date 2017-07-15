<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\Financial;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnGenerateCustomerInvoice {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate($invoiceAmount) {
        
        if ($this->salesOrder->getAttribute('pending_invoice.creator')) {
            return ['Tidak bisa membuat tagihan. Masih ada tagihan pending untuk SPK ini'];
        }
        
        $balance = $this->salesOrder->calculate()->SalesOrderBalance()['payment_unreceived'];
        if ($invoiceAmount > $balance) {
            return ['Jumlah Tagihan Ke Customer Melibihi Sisa Tagihan. Sisa Tagihan Customer Rp. ' . number_format($balance)];
        }
        
        return true;
    }
}
