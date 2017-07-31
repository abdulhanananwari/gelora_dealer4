<?php

namespace Gelora\Base\App\Unit\Transformers;

use League\Fractal;
use Gelora\Base\App\Unit\UnitModel;

class UnitDashboardTransformer extends Fractal\TransformerAbstract {

    protected $defaultIncludes = ['currentLocation'];

    public function transform(UnitModel $unit) {

        $data = [
            'current_status' => $unit->current_status,
            'current_status_text' => $unit->retrieve()->currentStatusText(),
            'brand' => $unit->brand,
            'type_name' => $unit->type_name,
            'type_code' => $unit->type_code,
            'color_name' => $unit->color_name,
            'color_code' => $unit->color_code,
            'assembly_year' => $unit->assembly_year,
            'current_location_id' => $unit->current_location_id,
        ];

        return $data;
    }

    public function includeCurrentLocation(UnitModel $unit) {

        if (is_null($unit->current_location_id)) {
            return null;
        }

        $location = $unit->currentLocation;

        return $this->item($location, new \Gelora\Base\App\Location\Transformers\LocationTransformer(), 'locations');
    }

}
