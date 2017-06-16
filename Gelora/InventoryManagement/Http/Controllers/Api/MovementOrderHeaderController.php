<?php

namespace Gelora\InventoryManagement\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class MovementOrderHeaderController extends Controller {
    
    protected $movementOrderHeader;

    public function __construct() {
        parent::__construct();
        $this->movementOrderHeader = new \Gelora\InventoryManagement\App\MovementOrderHeader\MovementOrderHeaderModel();
        $this->movementOrderDetail = new \Gelora\InventoryManagement\App\MovementOrderDetail\MovementOrderDetailModel;
        
        $this->transformer = new \Gelora\InventoryManagement\App\MovementOrderHeader\Transformers\MovementOrderHeaderTransformer();
        $this->dataName = 'movementOrderHeaders';
    }
    
    public function index(Request $request) {
        
        $query = $this->movementOrderHeader->newQuery();
        
        if ($request->has('active')) {
            $query->where('active', $request->get('active'));
        }

        
        if ($request->has('order')) {
            $query->orderBy('id', $request->get('order', 'asc'));
        }
        
        if ($request->has('paginate')) {
            
            $movementOrderHeaders = $query->paginate($request->get('paginate', 20));
            return $this->formatCollection($movementOrderHeaders, [], $movementOrderHeaders);
            
        } else {
            
            $movementOrderHeaders = $query->get();
            return $this->formatCollection($movementOrderHeaders);
        }

    }
    
    public function get($id, Request $request) {
        
        $movementOrderHeader = $this->movementOrderHeader->find($id);
        
        return $this->formatItem($movementOrderHeader);
    }
    
    public function store(Request $request) {
        
        $movementOrderHeader = $this->movementOrderHeader->assign()->fromRequest($request);

        $validation = $movementOrderHeader->validate()->onCreate();
        if($validation !== true) {
            return $this->formatErrors($validation);
        }
        
        $movementOrderHeader->save();
        
        return $this->formatItem($movementOrderHeader);
    }
    
    public function update($id, Request $request) {
        
        $movementOrderHeader = $this->movementOrderHeader->find($id);

        $validation = $movementOrderHeader->validate()->onCloseOrUpdate();
        if($validation !== true) {
            return $this->formatErrors($validation);
        }

        $movementOrderHeader->assign()->fromRequest($request);
        
        $movementOrderHeader->save();
        
        return $this->formatItem($movementOrderHeader);
    }

    public function close($id) {
        
        $movementOrderHeader = $this->movementOrderHeader->find($id);

        $validation = $movementOrderHeader->validate()->onCloseOrUpdate();
        if($validation !== true) {
            return $this->formatErrors($validation);
        }
        
        $movementOrderHeader->action()->onClose();

        return $this->formatItem($movementOrderHeader);
    }

    public function addMovementOrderDetail($id, Request $request) {

        $unit = \Gelora\Base\App\Unit\UnitModel::find($request->get('id'));

        $movementOrderDetail = $this->movementOrderDetail->assign()->fromUnit($id, $unit);

        $movementOrderDetail->save();
    }
}
