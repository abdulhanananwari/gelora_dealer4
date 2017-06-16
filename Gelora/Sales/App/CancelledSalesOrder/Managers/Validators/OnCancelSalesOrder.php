<?php

namespace Gelora\Sales\App\CancelledSalesOrder\Managers\Validators;

use Gelora\Sales\App\CancelledSalesOrder\CancelledSalesOrderModel;

class  OnCancelSalesOrder {

    protected $cancelledSalesOrder;

    public function __construct(CancelledSalesOrderModel $cancelledSalesOrder) {
        $this->cancelledSalesOrder = $cancelledSalesOrder;
    }

    public function validate() {

        if ($this->cancelledSalesOrder->usedSalesOrder->validated_at) {
            return ['SPK tidak dapat dibatalkan , karena sudah validasi'];
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
