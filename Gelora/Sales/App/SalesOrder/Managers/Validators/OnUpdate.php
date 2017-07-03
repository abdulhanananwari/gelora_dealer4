<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnUpdate {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {

        // if ($this->salesOrder->validated_at) {
        //     return ['Tidak dapat merubah data karena sudah divalidasi'];
        // }

        $attrValidation = $this->validateAttributes();
        if ($attrValidation->fails()) {
            return $attrValidation->errors()->all();
        }

        if ($this->salesOrder->sales_condition == 'kosong' && $this->salesOrder->payment_type == 'credit') {
            return ['Tidak dapat menggunakan kredit leasing untuk kondisi jual kosong'];
        }
        
        if ($this->salesOrder->payment_type == 'cash' && !is_null($this->salesOrder->leasing_order_id)) {
            return ['Tidak bisa menyimpan data PO untuk penjualan cash'];
        }

        return true;
    }

    protected function validateAttributes() {

        return \Validator::make($this->salesOrder->toArray(), [
            'customer' => 'required',
            'customer.name' => 'required:customer',
            'customer.phone_number' => 'required:customer',
        ]);
    }

}
