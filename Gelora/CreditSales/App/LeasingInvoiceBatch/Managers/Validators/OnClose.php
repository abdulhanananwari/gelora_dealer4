<?php

namespace Gelora\CreditSales\App\LeasingInvoiceBatch\Managers\validators;

use Gelora\CreditSales\App\LeasingInvoiceBatch\LeasingInvoiceBatchModel;

class OnClose {

    protected $leasingInvoiceBatch;

    public function __construct(LeasingInvoiceBatchModel $leasingInvoiceBatch) {
        $this->leasingInvoiceBatch = $leasingInvoiceBatch;
    }

    public function validate() {

        foreach ($this->leasingInvoiceBatch->getSalesOrders() as $salesOrder) {

            if (!$salesOrder->getAttribute('leasingOrder.po_number')) {
                return ['Batch tidak dapat ditutup karena nomor PO untuk SPK ' . $salesOrder->id . ' masih kosong'];
            }

            if (!$salesOrder->getAttribute('leasingOrder.invoice_generated_at')) {
                return ['Batch tidak dapat ditutup karena invoice untuk SPK ' . $salesOrder->id . ' belum dibuat'];
            }

            if ($salesOrder->getAttribute('leasingOrder.payment_at')) {
                return ['Batch tidak dapat ditutup karena pembayaran leasing untuk SPK ' . $salesOrder->id . ' sudah terisi'];
            }
        }

        return true;
    }

}
