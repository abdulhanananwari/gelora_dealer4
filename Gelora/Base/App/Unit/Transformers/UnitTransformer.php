<?php

namespace Gelora\Base\App\Unit\Transformers;

use League\Fractal;
use Gelora\Base\App\Unit\UnitModel;

class UnitTransformer extends Fractal\TransformerAbstract {

    protected $defaultIncludes = ['currentLocation'];

    public function transform(UnitModel $unit) {

        $data = [
            'id' => $unit->_id,
            'current_status' => $unit->current_status,
            'current_status_text' => $unit->retrieve()->currentStatusText(),
            'brand' => $unit->brand,
            'type_name' => $unit->type_name,
            'type_code' => $unit->type_code,
            'color_name' => $unit->color_name,
            'color_code' => $unit->color_code,
            'chasis_number' => $unit->chasis_number,
            'engine_number' => $unit->engine_number,
            'assembly_year' => $unit->assembly_year,
            'purchase_id' => $unit->purchase_id,
            'received_at' => $unit->received_at ? $unit->received_at->toDateTimeString() : null,
            'receiver' => $unit->receiver,
            'pdi_at' => $unit->pdi_at ? $unit->pdi_at->toDateTimeString() : null,
            'pdi_man' => $unit->pdi_man,
            'pdi_note' => $unit->pdi_note,
            'current_location_id' => $unit->current_location_id,
            'current_status' => $unit->current_status,
            'sj_number' => $unit->sj_number,
            'sj_date' => $unit->sj_number,
            'nd_number' => $unit->nd_number,
            'nd_date' => $unit->nd_number,
            'created_at' => $unit->created_at->toDateTimeString(),
            'updated_at' => $unit->updated_at->toDateTimeString(),
        ];


        if (\SolAuthClient::hasAccess('VIEW_COST_OF_GOOD')) {
            $data['cost_of_good'] = $unit->cost_of_good;
            $data['cost_of_good_entered_at'] = $unit->cost_of_good_entered_at ? $unit->cost_of_good_entered_at->toDateTimeString() : null;
        }

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
