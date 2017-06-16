<?php

namespace Gelora\Base\App\Price\Transformers;

use League\Fractal;
use Gelora\Base\App\Price\PriceModel;

class PricePlafondGroupTransformer extends Fractal\TransformerAbstract {
    
    public function transform(PriceModel $price) {
        
        return [
            'plafond_group' => $price->plafond_group,
        ];
    }
}
