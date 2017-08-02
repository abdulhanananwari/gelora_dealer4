<?php

namespace Gelora\Sales\Http\Controllers\Api\SalesOrder\Document;

use Gelora\Sales\Http\Controllers\Api\SalesOrderController;
use Illuminate\Http\Request;

// Kayanya usdah tidak dipakai. 17 Juli 2017

class SpkController extends SalesOrderController {

    public function __construct() {
        parent::__construct();
    }

    public function email($id) {

        $salesOrder = $this->salesOrder->find($id);

        $salesOrder->action()->onSendEmail();

        return $this->formatItem($salesOrder);
    }

}
