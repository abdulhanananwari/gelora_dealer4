<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\StatusChange;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnUnvalidate {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {

        if ($this->salesOrder->financial_closed_at) {
            return ['Data SPK tidak dapat dirubah karena transaksi keuangan utk SPK ini sudah ditutup'];
        }

        $deliveryNotGenerated = $this->validateDeliveryNotGenerated();
        if ($deliveryNotGenerated !== true) {
            return $deliveryNotGenerated;
        }

        $deliveryValidation = $this->validateExistingDeliveries();
        if ($deliveryValidation !== true) {
            return $deliveryValidation;
        }

        return true;
    }

    protected function validateDeliveryNotGenerated() {

        if ($this->salesOrder->getAttribute('delivery.generated_at')) {

            if (\SolAuthClient::hasAccess('UNVALIDATE_SALES_ORDER_AFTER_DELIVERY_GENERATED')) {

                return true;
            }

            return ['Tidak bisa membatalkan validasi karena SJ sudah dibuat dan Anda tidak punya akses pembatalan'];
        }

        return true;
    }

    protected function validateExistingDeliveries() {

        $deliveries = $this->salesOrder->deliveries;

        if (count($deliveries) > 0) {

            foreach ($deliveries as $delivery) {
                if (is_null($delivery->status) || $delivery->status == true) {
                    return ['Masih ada delivery yg dalam proses / sudah berhasil'];
                }
            }
        }

        return true;
    }

}
