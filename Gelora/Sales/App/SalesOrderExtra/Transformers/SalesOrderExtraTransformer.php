<?php

namespace Gelora\Sales\App\SalesOrderExtra\Transformers;

use League\Fractal;
use Gelora\Sales\App\SalesOrderExtra\SalesOrderExtraModel;

class SalesOrderExtraTransformer extends Fractal\TransformerAbstract {

    public function transform(SalesOrderExtraModel $salesOrderExtra) {

        
        return [
            'id' =>  $salesOrderExtra->_id,
            '_id' => $salesOrderExtra->_id,
            
            'item_name' => $salesOrderExtra->item_name, 
            'item_code' => $salesOrderExtra->item_code,
            
            'quantity' => (int) $salesOrderExtra->quantity, 
            'price_per_unit' => (int) $salesOrderExtra->price_per_unit, 
            'vat' => (int) $salesOrderExtra->vat, 
            'total' => (int) $salesOrderExtra->total, 
        ];
    }
    
}
