<?php

namespace Gelora\CreditSales\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class LeasingProgramController extends Controller {
    
    protected $program;
    
    public function __construct() {
        parent::__construct();
        $this->leasingProgram = new \Gelora\CreditSales\App\LeasingProgram\LeasingProgramModel();

        $this->transformer = new \Gelora\CreditSales\App\LeasingProgram\Transformers\LeasingProgramTransformer();
    }
    
    public function index(Request $request) {
        
        $query = $this->leasingProgram->newQuery();

        if ($request->has('by_compatible_leasing_order_id')) {
            
            $query = $this->leasingProgram->queryModify()->byLeasingOrderId($query, 
                    $request->get('by_compatible_leasing_order_id'));
        }
        
        if ($request->get('active') == 'true') {
            $query->where('active', true);
        }
        
        $leasingPrograms = $query->get();
        
        return $this->formatCollection($leasingPrograms);
    }
        
    public function get($id) {
        
        $leasingProgram = $this->leasingProgram->find($id);
        
        return $this->formatItem($leasingProgram);
    }
    
    public function store(Request $request) {
        
        $leasingProgram = $this->leasingProgram->assign()->fromRequest($request);
        
        $validation = $leasingProgram->validate()->onCreate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }
        
        $leasingProgram->save();
        
        return $this->formatItem($leasingProgram);
    }
    
    public function update($id, Request $request) {
        
        $leasingProgram = $this->leasingProgram->find($id);
        $leasingProgram->assign()->fromRequest($request);
        
        $validation = $leasingProgram->validate()->onCreate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }
        
        $leasingProgram->save();
        
        return $this->formatItem($leasingProgram);
    }
}
