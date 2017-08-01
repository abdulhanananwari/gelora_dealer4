<?php

namespace Gelora\Base\App\SalesProgram\Transformers;

use League\Fractal;
use Gelora\Base\App\SalesProgram\SalesProgramModel;

class SalesProgramTransformer extends Fractal\TransformerAbstract {
    
    public function transform(SalesProgramModel $salesProgram) {
        return [
            'id' => $salesProgram->_id,
            '_id' => $salesProgram->_id,
            'code' => $salesProgram->code,
            'name' => $salesProgram->name,
            'value' => $salesProgram->value,
            'note' => $salesProgram->note,
            
            'active' => (bool) $salesProgram->active,
            'valid_from' =>  $salesProgram->valid_from ? $salesProgram->valid_from->toDateString() : null,
            'valid_until' => $salesProgram->valid_until ? $salesProgram->valid_until->toDateString() : null,
        ];
    }
}
