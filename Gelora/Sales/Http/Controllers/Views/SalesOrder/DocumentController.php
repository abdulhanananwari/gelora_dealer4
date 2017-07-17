<?php

namespace Gelora\Sales\Http\Controllers\Views\SalesOrder;

use Gelora\Sales\Http\Controllers\Api\SalesOrderController;
use Illuminate\Http\Request;

class DocumentController extends SalesOrderController {

    public function __construct() {
        parent::__construct();
    }

    public function spk($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);

        return $salesOrder->generate()->spkPdf(true);
    }

    public function serviceBookBarcodeLabel($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);

//        return $salesOrder->generate()->spkPdf(true);

        return response($salesOrder->generate()->serviceBookLabel(true), 200, [
            'Content-Type' => 'application/pdf',
        ]);
    }

}
