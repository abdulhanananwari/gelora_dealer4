<?php

namespace Gelora\CreditSales\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class LeasingPersonnelController extends Controller {

    protected $leasingPersonnel;

    public function __construct() {
        parent::__construct();
        $this->leasingPersonnel = new \Gelora\CreditSales\App\LeasingPersonnel\LeasingPersonnelModel();

        $this->transformer = new \Gelora\CreditSales\App\LeasingPersonnel\Transformers\LeasingPersonnelTransformer();
        $this->dataName = 'leasing_personnels';
    }

    public function index(Request $request) {

        $query = $this->leasingPersonnel->newQuery();
        
//        exit($request->get('leasing.mainLeasing.id'));
        
        if ($request->has('main_leasing_id')) {
            $query->where('leasing.mainLeasing.id', (int) $request->get('main_leasing_id'));
        }

        $leasingPersonnels = $query->get();

        return $this->formatCollection($leasingPersonnels);
    }

    public function store(Request $request) {

        $leasingPersonnel = $this->leasingPersonnel->assign()->fromRequest($request);

        $validation = $leasingPersonnel->validate()->onCreateOrUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $leasingPersonnel->save();

        return $this->formatItem($leasingPersonnel);
    }

    public function update($id, Request $request) {

        $leasingPersonnel = $this->leasingPersonnel->find($id);
        $leasingPersonnel->assign()->fromRequest($request);
        
        $validation = $leasingPersonnel->validate()->onCreateOrUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }
        $leasingPersonnel->save();
        return $this->formatItem($leasingPersonnel);
    }

    public function get($id, Request $request) {

        $leasingPersonnel = $this->leasingPersonnel->find($id);

        return $this->formatItem($leasingPersonnel);
    }

    public function delete($id, Request $request) {

        $leasingPersonnel = $this->leasingPersonnel->find($id);
        $leasingPersonnel->delete();

        return $this->formatData(true);
    }

}
