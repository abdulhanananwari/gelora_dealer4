<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\Data;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Registration {

    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function validate($excludes = []) {
        
        $validators = [
            'registration.type' =>  'required',
            'registration.name' =>  'required',
            'registration.phone_number' =>  'required',
            'registration.address' =>  'required',
            'registration.ktp' =>  'required',
            'registration.id_file_uuid' =>  'required',
            'registration.entity_id' => 'required',
        ];
        
        foreach ($excludes as $exclude) {
            unset($validators[$exclude]);
        }
        
        $validation = \Validator::make($this->salesOrder->toArray(),
                $validators,
                [
                    'registration.id_file_uuid.required' => 'File KTP harus diupload'
                ]);
        
        return $validation->fails() ? $validation->errors()->all() : true;
    }
}
