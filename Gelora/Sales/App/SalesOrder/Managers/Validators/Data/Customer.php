<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\Data;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Customer {

    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function validate($excludes = []) {
        
        $validators = [
            'customer.type' =>  'required',
            'customer.name' =>  'required',
            'customer.phone_number' =>  'required',
            'customer.address' =>  'required',
            'customer.ktp' =>  'required',
            'customer.id_file_uuid' =>  'required',
            'customer.id' => 'required',
        ];
        
        foreach ($excludes as $exclude) {
            unset($validators[$exclude]);
        }
        
        $validation = \Validator::make($this->salesOrder->toArray(),
                $validators, [
                    'customer.type.required' => 'Jenis kustomer harus diisi',
                    'customer.ktp.required' => 'No KTP kustomer harus diisi',
                    'customer.id_file_uuid.required' => 'File KTP harus diupload'
                ]);
        
        return $validation->fails() ? $validation->errors()->all() : true;
    }
}
