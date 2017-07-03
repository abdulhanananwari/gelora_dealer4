<?php

namespace Gelora\Sales\Http\Controllers\Api\SalesOrder\Document;

use Gelora\Sales\Http\Controllers\Api\SalesOrderController;
use Illuminate\Http\Request;

class SpkController extends SalesOrderController {

    public function __construct() {
        parent::__construct();
    }

    public function generate($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);

        $x = $salesOrder->generate()->spkPdf();

        return response()->json(['url' => $x->getFullUrl()]);
    }

    public function email($id) {

        $salesOrder = $this->salesOrder->find($id);

        $salesOrder->action()->onSendEmail();

        return $this->formatItem($salesOrder);
    }

}
