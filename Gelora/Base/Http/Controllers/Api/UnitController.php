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

        if (request()->has('transformer')) {
            $transformer = '\\Gelora\\Base\\App\\Unit\\Transformers\\' . request()->get('transformer');
            $this->transformer = new $transformer;
        }

        $this->dataName = 'units';
    }

    public function index(Request $request) {

        $query = $this->unit->queryBuilder()->build($request);

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
