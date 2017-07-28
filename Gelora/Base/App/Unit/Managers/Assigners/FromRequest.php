<?php

namespace Gelora\Base\App\Unit\Managers\Assigners;

use Gelora\Base\App\Unit\UnitModel;
use MongoDB\BSON\UTCDateTime;

class FromRequest {

    protected $unit;

    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }

    public function assign(\Illuminate\Http\Request $request) {

        $keys = [
            'brand', 'type_name', 'type_code', 'color_name', 'color_code',
            'assembly_year', 'purchase_id',
            'sj_number', 'nd_number', 'current_status', 'current_location_id',
            'engine_number', 'chasis_number'
        ];

        $this->unit->fill($request->only($keys));

        $dates = ['sj_date', 'nd_date'];
        foreach ($dates as $date) {
            if ($request->has($date)) {
                $this->unit->$date = \Carbon\Carbon::createFromFormat('Ymd', $request->get($date))->today();
            }
        }

        if (\SolAuthClient::hasAccess('VIEW_COST_OF_GOOD')) {
            if ($request->get('cost_of_good', false) && $request->get('cost_of_good') > 0) {

                $this->unit->cost_of_good = (int) $request->get('cost_of_good');
                $this->unit->cost_of_good_entered_at = new UTCDateTime(\Carbon\Carbon::now()->timestamp * 1000);
            }
        }

        return $this->unit;
    }

}
