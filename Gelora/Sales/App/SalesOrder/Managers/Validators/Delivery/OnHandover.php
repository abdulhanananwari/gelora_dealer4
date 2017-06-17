<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\Delivery;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnHandover {
    
    protected $salesOrder;

    public function __construct(SalesOrderModel  $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function validate() {
        
        $default = $this->validateDefaultAttributes();
        if ($default->fails()) {
            return $default->errors()->all();
        }
        
        $successful = $this->validateAttributesIfSuccessful();
        if ($this->delivery->status == true && $successful->fails()) {
            return $successful->errors()->all();
        }
        
        $unsuccessful = $this->validateAttributesIfUnsuccessful();
        if ($this->delivery->status == false && $unsuccessful->fails()) {
            return $unsuccessful->errors()->all();
        }
        
        return true;
        
    }
    
    protected function validateDefaultAttributes() {
        
        return \Validator::make($this->salesOrder->toArray(),
                [
                    'delivery.handover_at' => 'required',
                    'delivery.status' => 'required',
                ]);
    }
    
    protected function validateAttributesIfSuccessful() {
        
        return \Validator::make($this->salesOrder->toArray(),
                [
                    'delivery.handover_name' => 'required',
                    'delivery.handover_phone_number' => 'required',
                ]);
    }
    
    protected function validateAttributesIfUnsuccessful() {
        
        return \Validator::make($this->salesOrder->toArray(),
                [
                    'delivery.handover_note' => 'required',
                ]);
    }
    
}
