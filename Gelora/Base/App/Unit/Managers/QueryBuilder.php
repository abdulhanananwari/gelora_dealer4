<?php

namespace Gelora\Base\App\Unit\Managers;

use Gelora\Base\App\Unit\UnitModel;

class QueryBuilder {

    protected $unit;

    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }

    public function build(\Illuminate\Http\Request $request) {

        $query = $this->unit->newQuery();

        if ($request->has('from')) {
            $from = \Carbon\Carbon::createFromFormat('Y-m-d', $request->get('from'))->startOfDay();
            $query->where('created_at', '>=', $from);
        }

        if ($request->has('until')) {
            $until = \Carbon\Carbon::createFromFormat('Y-m-d', $request->get('until'))->endOfDay();
            $query->where('created_at', '<=', $until);
        }
        if ($request->has('model_ids')) {
            $query->whereIn('model_id', explode(',', $request->get('model_ids')));
        }

        if ($request->has('engine_number')) {
            if ($request->get('engine_number_like') == 'true') {
                $query->where('engine_number', 'LIKE', '%' . $request->get('engine_number') . '%');
            } else {
                $query->where('engine_number', $request->get('engine_number'));
            }
        }

        if ($request->has('chasis_number')) {
            if ($request->get('chasis_number_like') == 'true') {
                $query->where('chasis_number', 'LIKE', '%' . $request->get('chasis_number') . '%');
            } else {
                $query->where('chasis_number', $request->get('chasis_number'));
            }
        }

        if ($request->get('pdi') == 'true' || $request->get('pdi') == 'done') {
            $query->whereNotNull('pdi_at');
        } else if ($request->get('pdi') == 'pending') {
            $query->whereNull('pdi_at');
        }

        if ($request->get('receipt') == 'done') {
            $query->whereNotNull('received_at');
        } else if ($request->get('receipt') == 'pending') {
            $query->whereNull('received_at');
        }

        if ($request->get('sales') == 'done') {
            $query->whereNotNull('sales_order_id');
        } else if ($request->get('sales') == 'pending') {
            $query->whereNull('sales_order_id');
        }

        if ($request->has('status')) {
            $query->where('current_status', $request->get('status'));
        } else if ($request->has('statuses_in')) {
            $query->whereIn('current_status', explode(',', $request->get('statuses_in')));
        }

        if ($request->has('status_not')) {
            $query->where('current_status', '!=', $request->get('status_not'));
        } else if ($request->has('statuses_not_in')) {
            $query->whereNotIn('current_status', explode(',', $request->get('statuses_not_in')));
        }

        if ($request->has('current_location_id_not')) {
            $query->where('current_location_id', '!=', $request->get('current_location_id_not'));
        } else if ($request->has('current_location_ids_not')) {
            $query->whereNotIn('current_location_id', explode(',', $request->get('current_location_ids_not')));
        }

        if ($request->has('current_location_id')) {
            $query->where('current_location_id', '=', $request->get('current_location_id'));
        } else if ($request->has('current_location_ids')) {
            $query->whereIn('current_location_id', explode(',', $request->get('current_location_ids')));
        }

        if ($request->has('type_code')) {
            $query->where('type_code', $request->get('type_code'));
        } else if ($request->has('type_codes')) {
            $query->whereIn('type_code', explode(',', $request->get('type_codes')));
        }

        if ($request->has('type_name')) {
            $query->where('type_name', $request->get('type_name'));
        }
        if ($request->has('sj_number')) {
            $query->where('sj_number', $request->get('sj_number'));
        }
        if ($request->has('nd_number')) {
            $query->where('nd_number', (int) $request->get('nd_number'));
        }
        if ($request->has('color_name')) {
            $query->where('color_name', $request->get('color_name'));
        }

        if ($request->has('color_code')) {
            $query->where('color_code', $request->get('color_code'));
        } else if ($request->has('color_codes')) {
            $query->whereIn('color_code', explode(',', $request->get('color_codes')));
        }

        if ($request->has('cost_of_good')) {
            if ($request->get('cost_of_good') == 'null') {
                $query->whereNull('cost_of_good');
            } else {
                $query->where('cost_of_good', $request->get('cost_of_good'));
            }
        }

        return $query;
    }

}
