<?php

namespace Gelora\Base\App\Unit\Transformers;

use Gelora\Base\App\Unit\UnitModel;

class UnitReportTransformer {

    public function transform(\Illuminate\Support\Collection $units) {

        $unitsArray = [];
        $keys = ['brand', 'type_name', 'type_code', 'color_name', 'color_code', 'engine_number', 'chasis_number', 'assembly_year', 'purchase_id', 'no_sj', 'no_nd', 'received_at', 'pdi_at', 'created_at'];
        foreach ($units as $unit) {

            $unitArray = [];

            // Fill keys
            foreach ($keys as $key) {

                if (isset($unit->$key)) {
                    $unitArray[$key] = $unit->$key;
                } else {
                    $unitArray[$key] = '';
                }
            }

            $unitArray['current_status'] = $unit->retrieve()->currentStatusText();
            $unitArray['current_location'] = $unit->retrieve()->currentLocationName();

            if ($unit->received_at) {
                $unitArray['receiver'] = $unit->retrieve()->receiverName();
            }

            if ($unit->pdi_at) {
                $unitArray['pdi_man'] = $unit->retrieve()->pdiManName();
            }

            if (\SolAuthClient::hasAccess('VIEW_COST_OF_GOOD')) {
                $unitArray['cost_of_good'] = $unit->cost_of_good;
            }

            $unitsArray[] = $unitArray;
        }


        return $unitsArray;
    }

}
