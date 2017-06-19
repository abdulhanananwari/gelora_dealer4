<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\PolReg;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class ItemOutgoing {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate($itemName, \Illuminate\Http\Request $request) {
        
        $incoming = $this->salesOrder->subDocument()->polReg()->get('items.' . $itemName . '.outgoing');
        if (!empty($incoming)) {
            return ['Penerimaan sudah dibuat sebelumnya'];
        }
        
        $requestValidation = $this->validateRequest($request);
        if ($requestValidation->fails()) {
            return $requestValidation->errors()->all();
        }
        
        return true;
    }
    
    protected function validateRequest($request) {
        
        return \Validator::make($request->all(), [
            'receiver_name' => 'required',
        ]);
    }

}
