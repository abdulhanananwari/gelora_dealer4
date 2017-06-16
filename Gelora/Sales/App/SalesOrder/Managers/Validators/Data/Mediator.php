<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\Data;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Mediator {

    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function validate($excludes = []) {
        
        $validators = [
            'mediator.name' => 'required',
            'mediator.entity_id' => 'required',
            'mediator.id_file_uuid' => 'required',
            'mediator.ktp' => 'required',
        ];
       
        foreach ($excludes as $exclude) {
            unset($validators[$exclude]);
        }
        
        $validation = \Validator::make($this->salesOrder->toArray(), $validators);
        
        return $validation->fails() ? $validation->errors()->all() : true;
    }
}
