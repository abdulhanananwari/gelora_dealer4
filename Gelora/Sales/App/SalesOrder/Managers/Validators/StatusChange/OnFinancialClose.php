<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\StatusChange;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnFinancialClose {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {
        
        $leasingPaymentValidation = $this->validateLeasingPayment();
        if ($leasingPaymentValidation !== true) {
            return $leasingPaymentValidation;
        }
        
        $paymentUnreceived = $this->salesOrder->calculate()->SalesOrderBalance()['payment_unreceived'];
        if ($paymentUnreceived !== 0) {
            return ['SPK belum bisa di tutup karena kustomer masih mempunyai hutang Rp ' . number_format($paymentUnreceived)];
        }
        
        $totalCost = collect($this->salesOrder->getAttribute('polReg.costs'))->sum('amount');
        if ($totalCost <= 0) {
            return ['Biaya PolReg belum di input'];
        }

        if (empty($this->salesOrder->getAttribute('polReg.agency_invoice_id'))) {
            return ['Batch invoice biro jasa belum diassign'];
        }

        return true;
    }
    
    protected function validateLeasingPayment() {
        
        if ($this->salesOrder->payment_type == 'credit' && !$this->salesOrder->getAttribute('leasingOrder.payment_at')) {
            return ['PO Leasing belum cair'];
        }
        
        // Kemungkinan perlu ditambah validasi pembayaran join promo
        
        return true;
    }
    
}
