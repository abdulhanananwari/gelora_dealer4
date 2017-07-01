<?php

namespace Gelora\Sales\Http\Controllers\Api\SalesOrder\Action;

use Gelora\Sales\Http\Controllers\Api\SalesOrderController as Controller;
use Illuminate\Http\Request;

class IndentController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function indent($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);

        $validation = $salesOrder->validate()->statusChange()->onIndent();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $salesOrder->action()->status()->onIndent($request->get('note'));

        return $this->formatItem($salesOrder);
    }

}
