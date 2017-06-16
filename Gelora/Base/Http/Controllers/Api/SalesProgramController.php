<?php

namespace Gelora\Base\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class SalesProgramController extends Controller {
    
    protected $salesProgram;

    public function __construct() {
        parent::__construct();
        $this->salesProgram = new \Gelora\Base\App\SalesProgram\SalesProgramModel();
        
        $this->transformer = new \Gelora\Base\App\SalesProgram\Transformers\SalesProgramTransformer();
        $this->dataName = 'sales_programs';
    }
    
    public function index(Request $request) {
        
        $query = $this->salesProgram->newQuery();
        
        if ($request->get('active') == 'true') {
            $query->where('valid_from', '<=', \Carbon\Carbon::now())
                    ->where('valid_until', '>=', \Carbon\Carbon::now());
            
//            $query->where('active', (bool) $request->get('active'));
        }
        
        $salesPrograms = $query->get();
        
        return $this->formatCollection($salesPrograms);
    }
    
    public function get($id, Request $request) {
        
        $salesProgram = $this->salesProgram->find($id);
        
        return $this->formatItem($salesProgram);
    }
    
    public function store(Request $request) {
        
        $salesProgram = $this->salesProgram->assign()->fromRequest($request);
        
        $salesProgram->save();
        
        return $this->formatItem($salesProgram);
    }
    
    public function update($id, Request $request) {
        
        $salesProgram = $this->salesProgram->find($id);
        $salesProgram->assign()->fromRequest($request);
        
        $salesProgram->save();
        
        return $this->formatItem($salesProgram);
    }
}
