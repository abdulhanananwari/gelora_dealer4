<?php

namespace Gelora\Base\App\Price\Transformers;

use League\Fractal;
use Gelora\Base\App\Price\PriceModel;

class PriceTransformer extends Fractal\TransformerAbstract {
    
    public function transform(PriceModel $price) {
        
        return [
            'model_id' => (int) $price->model_id,
            
            'model_code' => $price->model_code,
            'model_name' => $price->model_name,
            
            'plafond_group' => $price->plafond_group,
            
            'colors' => $price->colors ? json_decode($price->colors) : [],
            
            'off_the_road' => (double) $price->off_the_road,
            'on_the_road' => (double) $price->on_the_road,
            
            'registration_fee' => (double) $price->registration_fee,
            'max_registration_process_fee' => (double) $price->max_registration_process_fee,
            
            'extras' => (array) $price->extras,
            
            'created_at' => $price->created_at->toDateTimeString(),
            'updated_at' => $price->updated_at->toDateTimeString(),
        ];
    }
}
