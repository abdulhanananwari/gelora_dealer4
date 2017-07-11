<?php

namespace Gelora\Sales\Http\Controllers\Api\SalesOrder;

use Gelora\Sales\Http\Controllers\Api\SalesOrderController;
use Illuminate\Http\Request;

class SpecificUpdateController extends SalesOrderController {

    protected $salesOrder;

    public function __construct() {
        parent::__construct();
    }

    public function price($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);
        $salesOrder->assign()->specific()->price($request);

        $validation = $salesOrder->validate()->onUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $salesOrder->save();

        return $this->formatItem($salesOrder);
    }

    public function plafond($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);
        $salesOrder->assign()->specific()->plafond($request->get('plafond'));

        $validation = $salesOrder->validate()->onUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $salesOrder->save();

        return $this->formatItem($salesOrder);
    }

    public function insertNote($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);
        $salesOrder->assign()->specific()->insertNote($request);

        $salesOrder->save();

        return $this->formatItem($salesOrder);
    }

    public function registration($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);
        $salesOrder->assign()->specific()->registration($request);

        $validation = $salesOrder->validate()->specific()->registration();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $salesOrder->save();
        return $this->formatItem($salesOrder);
    }

    public function deliveryRequest($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);
        $salesOrder->assign()->specific()->deliveryRequest($request);

        $validation = $salesOrder->validate()->specific()->deliveryRequest();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $salesOrder->save();

        return $this->formatItem($salesOrder);
    }

}
