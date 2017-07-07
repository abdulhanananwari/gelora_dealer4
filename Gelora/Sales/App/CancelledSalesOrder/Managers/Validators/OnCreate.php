<?php

namespace Gelora\Sales\App\CancelledSalesOrder\Managers\Validators;

use Gelora\Sales\App\CancelledSalesOrder\CancelledSalesOrderModel;

class OnCreate {

    protected $cancelledSalesOrder;

    public function __construct(CancelledSalesOrderModel $cancelledSalesOrder) {
        $this->cancelledSalesOrder = $cancelledSalesOrder;
    }

    public function validate() {

        if ($this->cancelledSalesOrder->getAttribute('salesOrder.delivery.generated_at')) {
            return ['SPK tidak dapat dibatalkan karena sudah dibuat SJ'];
        }

        $attrValidation = $this->validateAttributes();
        if ($attrValidation->fails()) {
            return $attrValidation->errors()->all();
        }

        return true;
    }

    protected function validateAttributes() {

        return \Validator::make($this->cancelledSalesOrder->toArray(), [
                    'reason' => 'required',
        ]);
    }

}
