<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\Financial;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnGenerateCustomerInvoice {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate(\Illuminate\Http\Request $request) {
        
        $updateValidation = $this->salesOrder->validate()->financial()->onUpdate();
        if ($updateValidation !== true) {
            return $updateValidation;
        }
        
        if ($this->salesOrder->getAttribute('customerInvoice.creator')) {
            return ['Tidak bisa membuat tagihan. Masih ada tagihan pending untuk SPK ini'];
        }
        
        $balance = $this->salesOrder->calculate()->SalesOrderBalance()['payment_unreceived'];
        if ((int) $request->get('amount') > $balance) {
            return ['Jumlah Tagihan Ke Customer Melibihi Sisa Tagihan. Sisa Tagihan Customer Rp. ' . number_format($balance)];
        }
        
        if (!$request->get('delegate_name')) {
            return ['Nama pengirim tagihan harus diisi'];
        }
        
        return true;
    }
}
