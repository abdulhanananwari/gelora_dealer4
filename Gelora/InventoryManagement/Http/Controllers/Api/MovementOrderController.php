<?php

namespace Gelora\InventoryManagement\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class MovementOrderController extends Controller {

    protected $movementOrder;

    public function __construct() {
        parent::__construct();
        $this->movementOrder = new \Gelora\InventoryManagement\App\MovementOrder\MovementOrderModel();

        $this->transformer = new \Gelora\InventoryManagement\App\MovementOrder\Transformers\MovementOrderTransformer();
        $this->dataName = 'movementOrders';
    }

    public function index(Request $request) {

        $query = $this->movementOrder->newQuery();

        if ($request->has('active')) {
            $query->where('active', $request->get('active'));
        }

        $query->orderBy('id', $request->get('order', 'asc'));

        if ($request->has('paginate')) {
            $movementOrders = $query->paginate((int) $request->get('paginate', 20));
            return $this->formatCollection($movementOrders, [], $movementOrders);
        } else {
            $movementOrders = $query->get();
            return $this->formatCollection($movementOrders);
        }
    }

    public function get($id, Request $request) {
        $movementOrder = $this->movementOrder->find($id);
        return $this->formatItem($movementOrder);
    }

    public function store(Request $request) {

        $movementOrder = $this->movementOrder->assign()->fromRequest($request);

        $validation = $movementOrder->validate()->onCreate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $movementOrder->save();

        return $this->formatItem($movementOrder);
    }

    public function update($id, Request $request) {

        $movementOrder = $this->movementOrder->find($id);

        $validation = $movementOrder->validate()->onCloseOrUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $movementOrder->assign()->fromRequest($request);

        $movementOrder->save();

        return $this->formatItem($movementOrder);
    }

    public function close($id) {

        $movementOrder = $this->movementOrder->find($id);

        $validation = $movementOrder->validate()->onCloseOrUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $movementOrder->action()->onClose();

        return $this->formatItem($movementOrder);
    }
}
