<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\Data;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Price {

    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function validate($excludes = []) {
        
        $validators = [
            'sales_condition' => 'required|in:isi,kosong',
            'payment_type' => 'required|in:cash,credit',
            'on_the_road' => 'required_if:sales_condition,isi',
            'off_the_road' => 'required_if:sales_condition,kosong',
            'discount' => 'numeric|min:0'
        ];
        
        foreach ($excludes as $exclude) {
            unset($validators[$exclude]);
        }
        
        $validation = \Validator::make($this->salesOrder->toArray(), $validators);
        
        return $validation->fails() ? $validation->errors()->all() : true;
    }
}
