<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnGenerateInvoice {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {

        if (!request()->has('bypass_handover_validation') &&
                empty($this->salesOrder->subDocument()->delivery()->get('handover.created_at'))) {

            return [
                    [
                    'type' => 'confirm',
                    'text' => 'SJ belum serah terima dengan konsumen. Yakin mau buat tagihan?',
                    'if_confirmed' => 'bypass_handover_validation'
                ]
            ];
        }

        return true;
    }

}
