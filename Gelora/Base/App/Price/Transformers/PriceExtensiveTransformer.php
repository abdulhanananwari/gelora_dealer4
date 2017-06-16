<?php

namespace Gelora\Base\App\Price\Transformers;

use Gelora\Base\App\Price\Transformers\PriceTransformer;
use Gelora\Base\App\Price\PriceModel;

class PriceExtensiveTransformer extends PriceTransformer {

    public function transform(PriceModel $price) {

        $transformed = parent::transform($price);
        $transformed['cost_of_good'] = (double) $price->cost_of_good;

        return $transformed;
    }

}
