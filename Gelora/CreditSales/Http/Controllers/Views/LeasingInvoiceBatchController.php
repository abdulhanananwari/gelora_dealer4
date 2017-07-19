<?php

namespace Gelora\CreditSales\Http\Controllers\Views;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class LeasingInvoiceBatchController extends Controller {

    protected $leasingInvoiceBatch;

    public function __construct() {
        parent::__construct();
        $this->leasingInvoiceBatch = new \Gelora\CreditSales\App\LeasingInvoiceBatch\LeasingInvoiceBatchModel();
    }

    public function generateLeasingInvoice($id) {

        $leasingInvoiceBatch = $this->leasingInvoiceBatch->find($id);

        $viewData = [
            'leasingInvoiceBatch' => $leasingInvoiceBatch
        ];

        return view()->make('gelora.creditSales::leasingInvoiceBatch.receipt')
                        ->with('viewData', $viewData);
    }

}
