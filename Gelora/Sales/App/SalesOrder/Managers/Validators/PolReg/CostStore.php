<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\PolReg;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class CostStore {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function validate($itemName, \Illuminate\Http\Request $request) {
        
        $cost = $this->salesOrder->subDocument()->polReg()->get('costs.' . $itemName . '.creator');
        if (!empty($cost)) {
            return ['Biaya sudah dibuat sebelumnya'];
        }
        
        $requestValidation = $this->validateRequest($request);
        if ($requestValidation->fails()) {
            return $requestValidation->errors()->all();
        }
        
        return true;
    }
    
    protected function validateRequest($request) {
        
        return \Validator::make($request->all(), [
            'amount' => 'required',
        ]);
    }


}
