<?php

namespace Gelora\CreditSales\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;
use MongoDB\BSON\ObjectID;

class LeasingController extends Controller {

    protected $leasing;

    public function __construct() {
        parent::__construct();
        $this->leasing = new \Gelora\CreditSales\App\Leasing\LeasingModel();

        $this->transformer = new \Gelora\CreditSales\App\Leasing\Transformers\LeasingTransformer();
        $this->dataName = 'leasings';
    }

    public function index(Request $request) {

        $query = $this->leasing->newQuery();

        if ($request->get('leasing_personnel_access') == 'true') {

            $leasingPersonnel = \Gelora\CreditSales\App\LeasingPersonnel\LeasingPersonnelModel::
                    where('user.id', \ParsedJwt::getByKey('sub'))->first();

            $query->where('mainLeasing.id', $leasingPersonnel['leasing']['mainLeasing']['id']);
        }

        $leasings = $query->get();

        return $this->formatCollection($leasings);
    }

    public function store(Request $request) {

        $leasing = $this->leasing->assign()->fromRequest($request);

        $validation = $leasing->validate()->onCreate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $leasing->save();

        return $this->formatItem($leasing);
    }

    public function update($id, Request $request) {

        $leasing = $this->leasing->where('mainLeasing.id', (int) $id)->first();
        $leasing->assign()->fromRequest($request);

        $validation = $leasing->validate()->onUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }
        $leasing->save();

        return $this->formatItem($leasing);
    }

    public function get($id, Request $request) {

        $leasing = $this->leasing->where('mainLeasing.id', (int) $id)->first();

        return $this->formatItem($leasing);
    }

}
