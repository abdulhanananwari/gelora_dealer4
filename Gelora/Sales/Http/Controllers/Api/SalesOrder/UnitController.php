<?php

namespace Gelora\Sales\Http\Controllers\Api\SalesOrder;

use Gelora\Sales\Http\Controllers\Api\SalesOrderController;
use Illuminate\Http\Request;

class UnitController extends SalesOrderController {

    protected $salesOrder;

    public function __construct() {
        parent::__construct();
    }

    public function deselect($id) {

        $salesOrder = $this->salesOrder->find($id);

        /* $validation = $salesOrder->validate()->unit()->onDeselect();
          if ($validation !== true) {
          return $this->formatErrors($validation);
          } */

        $salesOrder->action()->unit()->onDeselect();

        return $this->formatItem($salesOrder);
    }

}
