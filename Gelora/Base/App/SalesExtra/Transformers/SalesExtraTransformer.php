<?php

namespace Gelora\Base\App\SalesExtra\Transformers;

use League\Fractal;
use Gelora\Base\App\SalesExtra\SalesExtraModel;

class SalesExtraTransformer extends Fractal\TransformerAbstract {
    
    public function transform(SalesExtraModel $salesExtra) {
        return [
        
            'id' => $salesExtra->_id,
            '_id' => $salesExtra->_id,
            'name' => $salesExtra->name,
            'type' => $salesExtra->type,
        ];
    }
}
