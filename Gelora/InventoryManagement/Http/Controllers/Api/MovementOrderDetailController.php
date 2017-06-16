<?php

namespace Gelora\InventoryManagement\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class MovementOrderDetailController extends Controller {
    
    protected $movementOrderHeader;
    protected $movementOrderDetail;
    protected $unit;

    public function __construct() {
        parent::__construct();
        $this->movementOrderHeader = new \Gelora\InventoryManagement\App\MovementOrderHeader\MovementOrderHeaderModel;
        $this->movementOrderDetail = new \Gelora\InventoryManagement\App\MovementOrderDetail\MovementOrderDetailModel;
        $this->unit = new \Gelora\Base\App\Unit\UnitModel;
        
        $this->transformer = new \Gelora\InventoryManagement\App\MovementOrderDetail\Transformers\MovementOrderDetailTransformer;
        $this->dataName = 'movementOrderDetails';
    }
    
    public function store(Request $request) {
        
        $unit = $this->unit->find($request->get('unit_id'));
        
        $movementOrderDetail = $this->movementOrderDetail->assign()->fromUnit($request->get('movement_order_header_id'), $unit);
        
//        $validation = $movementOrderHeader->validate()->onCreate();
//        if($validation !== true) {
//            return $this->formatErrors($validation);
//        }
        
        $movementOrderDetail->save();
        
        return $this->formatItem($movementOrderDetail);
    }
    
    public function delete($id) {
        
        $movementOrderHeader = $this->movementOrderHeader->find($id);

        $validation = $movementOrderHeader->validate()->onCloseOrUpdate();
        if($validation !== true) {
            return $this->formatErrors($validation);
        }
        
        $movementOrderHeader->action()->onClose();

        return $this->formatItem($movementOrderHeader);
    }
}
