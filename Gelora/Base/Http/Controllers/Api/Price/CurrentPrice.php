<?php

namespace Gelora\Base\Http\Controllers\Api\Price;

use Illuminate\Http\Request;

trait CurrentPrice {

    public function currentPriceByModelId($modelId) {

        $price = $this->price->where('model_id', $modelId)
                ->orderBy('id', 'desc')
                ->first();

        return $this->formatItem($price);
    }

}
