<?php

namespace Gelora\Base\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;
use Gelora\Base\Http\Controllers\Api\Unit\UniqueType;
use Gelora\Base\Http\Controllers\Api\Unit\Action;
use Gelora\Base\Http\Controllers\Api\Unit\Maintenance;

class UnitController extends Controller {

    use UniqueType,
        Action,
        Maintenance;

    protected $unit;

    public function __construct() {
        parent::__construct();
        $this->unit = new \Gelora\Base\App\Unit\UnitModel();

        $this->transformer = new \Gelora\Base\App\Unit\Transformers\UnitTransformer();
        $this->dataName = 'units';
    }

    public function index(Request $request) {

        $query = $this->unit->newQuery();

        if ($request->has('model_ids')) {
            $query->whereIn('model_id', explode(',', $request->get('model_ids')));
        }

        if ($request->has('engine_number')) {
            $query->where('engine_number', 'LIKE', '%' . $request->get('engine_number') . '%');
        }

        if ($request->has('chasis_number')) {
            $query->where('chasis_number', 'LIKE', '%' . $request->get('chasis_number') . '%');
        }
        
        if ($request->get('pdi') == true) {
            $query->whereNotNull('pdi_at');
        }
        
        if ($request->get('received') == true) {
            $query->whereNotNull('received_at');
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

        if ($request->has('transformer')) {
            // Dicheck dulu punya akses ga untuk liat harga check access dulu

            $transformer = '\\Gelora\\Base\\App\\Unit\\Transformers\\' . $request->get('transformer');
            $this->transformer = new $transformer;
        }

        if ($request->has('paginate')) {

            $units = $query->paginate((int) $request->get('paginate', 20));
            return $this->formatCollection($units, [], $units);
        } else {

            $units = $query->get();
            return $this->formatCollection($units);
        }
    }

    public function get($id) {

        $unit = $this->unit->find($id);

        return $this->formatItem($unit);
    }

    public function store(Request $request) {

        $unit = $this->unit->assign()->fromRequest($request);

        $validation = $this->unit->validate()->onCreate()->fromPurchaseSimple();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $unit->action()->onCreate();

        return $this->formatItem($unit);
    }

    public function update($id, Request $request) {

        $unit = $this->unit->find($id);
        $unit->assign()->fromRequest($request);

        $validation = $unit->validate()->onUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $unit->action()->onUpdate();

        return $this->formatItem($unit);
    }

}
