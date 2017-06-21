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
            return ['Penyerahan sudah dibuat sebelumnya'];
        }
        if ($itemName == 'BPKB' && $this->salesOrder->payment_type == 'credit') {
            return ['Penjualan adalah kredit, BPKB tidak dapat diserahkan langsung ke customer '];
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
