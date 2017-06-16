<?php

namespace Gelora\Base\App\Location\Transformers;

use League\Fractal;
use Gelora\Base\App\Location\LocationModel;

class LocationTransformer extends Fractal\TransformerAbstract {
    
    public function transform(LocationModel $location) {
        return [
            'id' => $location->_id,
            '_id' => $location->_id,
            
            'name' => $location->name,
            'type' => $location->type,
            
            'active' => (bool) $location->active,
            'capacity' => (int) $location->capacity,
        ];
    }
}
