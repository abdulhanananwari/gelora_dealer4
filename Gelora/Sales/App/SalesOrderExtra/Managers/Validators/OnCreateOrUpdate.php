<?php

namespace Gelora\Sales\App\SalesOrderExtra\Managers\Validators;

use Gelora\Sales\App\SalesOrderExtra\SalesOrderExtraModel;

class OnCreateOrUpdate {

    protected $salesOrderExtra;

    public function __construct(SalesOrderExtraModel $salesOrderExtra) {
        $this->salesOrderExtra = $salesOrderExtra;
    }

    public function validate() {
        
        $attrValidation = $this->validateAttributes();
        if ($attrValidation->fails()) {
            return $attrValidation->errors()->all();
        }
        
        if ($this->salesOrderExtra->salesOrder->validated_at) {
            return ['Penjualan sudah ditutup. Tidak bisa diedit lagi'];
        }
        
        return true;
    }
    
    protected function validateAttributes() {
        
        return \Validator::make($this->salesOrderExtra->toArray(), [
            'sales_order_id' => 'required',
            'item_name' => 'required',
            'quantity' => 'required|numeric',
            'price_per_unit' => 'required|numeric',
            // 'vat' => 'required|min:0|max:' . $this->salesOrderExtra->calculate()->totalBefVat() . '|numeric',
        ]);
    }
    
}
