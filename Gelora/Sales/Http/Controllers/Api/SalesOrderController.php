<?php

namespace Gelora\Sales\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;
use MongoDB\BSON\ObjectID;

class SalesOrderController extends Controller {

    protected $salesOrder;

    public function __construct() {
        parent::__construct();
        $this->salesOrder = new \Gelora\Sales\App\SalesOrder\SalesOrderModel();

        $this->transformer = new \Gelora\Sales\App\SalesOrder\Transformers\SalesOrderTransformer();
        $this->dataName = 'sales_orders';

        if (request()->has('transformer')) {
            $transformer = '\\Gelora\\Sales\\App\\SalesOrder\\Transformers\\' . request()->get('transformer');
            $this->transformer = new $transformer;
        }
    }

    public function index(Request $request) {
        
        $query = $this->salesOrder->newQuery();

        $query = $this->salesOrder->queryBuilder()->build($query, $request);

        switch ($request->get('transformer')) {
            case 'simple':
                $this->transformer = new \Gelora\Sales\App\SalesOrder\Transformers\SalesOrderSimpleTransformer();
                break;
            case 'dashboard':
                $this->transformer = new \Gelora\Sales\App\SalesOrder\Transformers\SalesOrderDashboardTransformer();
                break;
            default:
                break;
        }

        if ($request->has('paginate')) {

            $salesOrders = $query->paginate((int) $request->get('paginate', 20));
            return $this->formatCollection($salesOrders, [], $salesOrders);
        } else {

            $salesOrders = $query->get();
            return $this->formatCollection($salesOrders);
        }
    }

    public function get($id) {

        $salesOrder = $this->salesOrder->find($id);

        return $this->formatItem($salesOrder);
    }

    public function store(Request $request) {

        $salesOrder = $this->salesOrder->assign()->onCreateAndUpdate($request);

        $validation = $salesOrder->validate()->onCreate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $salesOrder->action()->onCreate();

        return $this->formatItem($salesOrder);
    }

    public function update($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);
        $salesOrder->assign()->onCreateAndUpdate($request);

        $validation = $salesOrder->validate()->onUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $salesOrder->action()->onUpdate();

        return $this->formatItem($salesOrder);
    }

    public function calculate($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);

        return response()->json(['data' => $salesOrder->calculate()->salesOrderBalance()]);
    }

}
