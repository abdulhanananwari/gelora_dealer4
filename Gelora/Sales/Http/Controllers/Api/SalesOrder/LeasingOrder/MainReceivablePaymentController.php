<?php

namespace Gelora\Sales\Http\Controllers\Api\SalesOrder\LeasingOrder;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class MainReceivablePaymentController extends Controller {

    protected $salesOrder;

    public function __construct() {
        parent::__construct();
        $this->salesOrder = new \Gelora\Sales\App\SalesOrder\SalesOrderModel();

        $this->transformer = new \Gelora\Sales\App\SalesOrder\Transformers\SalesOrderTransformer();
        $this->dataName = 'sales_orders';
    }

    public function validate($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);
        $validation = $salesOrder->validate()->leasingOrder()->onMainReceivablePayment();

        return $this->formatData([
                    'status' => ($validation === true),
                    'validation' => $validation,
        ]);
    }

    public function store($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);

        $salesOrder->assign()->specific()->leasingOrder()->mainReceivablePayment($request);

        $validation = $salesOrder->validate()->leasingOrder()->onMainReceivablePayment();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $salesOrder->action()->leasingOrder()->onMainReceivablePayment();

        return $this->formatItem($salesOrder);
    }

}
