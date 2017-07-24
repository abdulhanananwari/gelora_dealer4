<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\Delivery;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnHandover {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {
        
        $default = $this->validateDefaultAttributes();
        if ($default !== true) {
            return $default;
        }

        $scannedValidation = $this->validateUnitScanned();
        if ($scannedValidation !== true) {
            return $scannedValidation;
        }

        return true;
    }

    protected function validateDefaultAttributes() {

        if (empty($this->salesOrder->getAttribute('delivery.handover.receiver.name'))) {
            return ['Nama penerima harus diisi'];
        }

        if (empty($this->salesOrder->getAttribute('delivery.handover.receiver.phone_number'))) {
            return ['Nomor telepon penerima harus diisi'];
        }

        return true;
    }

    protected function validateUnitScanned() {

        if (!request()->get('bypass_scanned_validation') && empty($this->salesOrder->subDocument()->delivery()->scanner)) {

            return [
                    [
                    'text' => 'Unit belum di scan. Jika yakin unit sudah betul, klik konfirm',
                    'type' => 'confirm',
                    'if_confirmed' => 'bypass_scanned_validation'
                ]
            ];
        }

        return true;
    }

}
