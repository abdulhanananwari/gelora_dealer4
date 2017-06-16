<?php

namespace Gelora\Base\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class LocationController extends Controller {
    
    protected $location;

    public function __construct() {
        parent::__construct();
        $this->location = new \Gelora\Base\App\Location\LocationModel();
        
        $this->transformer = new \Gelora\Base\App\Location\Transformers\LocationTransformer();
        $this->dataName = 'locations';
    }
    
    public function index(Request $request) {
        
        $query = $this->location->newQuery();
        
        if ($request->has('active')) {
            $query->where('active', (bool) $request->get('active'));
        }
        
        $locations = $query->get();
        
        return $this->formatCollection($locations);
    }
    
    public function get($id, Request $request) {
        
        $location = $this->location->find($id);
        
        return $this->formatItem($location);
    }
    
    public function store(Request $request) {
        
        $location = $this->location->assign()->fromRequest($request);
        
        $location->save();
        
        return $this->formatItem($location);
    }
    
    public function update($id, Request $request) {
        
        $location = $this->location->find($id);
        $location->assign()->fromRequest($request);
        
        $location->save();
        
        return $this->formatItem($location);
    }
}
