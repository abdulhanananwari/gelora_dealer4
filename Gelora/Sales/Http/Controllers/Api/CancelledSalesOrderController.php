<?php

namespace Gelora\Sales\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class CancelledSalesOrderController extends Controller {

    protected $cancelledSalesOrder;

    public function __construct() {
        parent::__construct();
        $this->cancelledSalesOrder = new \Gelora\Sales\App\CancelledSalesOrder\CancelledSalesOrderModel();

        $this->transformer = new \Gelora\Sales\App\CancelledSalesOrder\Transformers\CancelledSalesOrderTransformer();
        $this->dataName = 'cancelled_sales_orders';
    }

    public function index(Request $request) {

        $query = $this->cancelledSalesOrder->newQuery();
        
        $query->orderBy($request->get('order_by', 'created_at'), $request->get('order', 'asc'));

        if ($request->has('paginate')) {

            $cancelledSalesOrders = $query->paginate((int) $request->get('paginate', 20));
            return $this->formatCollection($cancelledSalesOrders, [], $cancelledSalesOrders);
        } else {

            $cancelledSalesOrders = $query->get();
            return $this->formatCollection($cancelledSalesOrders);
        }
    }

    public function get($id, Request $request) {

        $cancelledSalesOrder = $this->cancelledSalesOrder->find($id);
        return $this->formatItem($cancelledSalesOrder);
    }

    public function store(Request $request) {

        $cancelledSalesOrder = $this->cancelledSalesOrder->assign()->fromRequest($request);

        $validation = $cancelledSalesOrder->validate()->onCreate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $cancelledSalesOrder->action()->onCreate();

        return $this->formatItem($cancelledSalesOrder);
    }

    public function restore($id, Request $request) {

        $cancelledSalesOrder = $this->cancelledSalesOrder->find($id);

        $validation = $cancelledSalesOrder->validate()->onRestore();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $salesOrder = $cancelledSalesOrder->action()->onRestore();

        return $this->formatItem($cancelledSalesOrder);
    }

}
