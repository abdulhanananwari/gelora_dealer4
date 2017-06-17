<?php

namespace Gelora\Sales\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class SalesOrderController extends Controller {

    protected $salesOrder;

    public function __construct() {
        parent::__construct();
        $this->salesOrder = new \Gelora\Sales\App\SalesOrder\SalesOrderModel();

        $this->transformer = new \Gelora\Sales\App\SalesOrder\Transformers\SalesOrderTransformer();
        $this->dataName = 'sales_orders';
    }

    public function index(Request $request) {
        
        $query = $this->salesOrder->newQuery();

        if ($request->has('from')) {
            $from = \Carbon\Carbon::createFromFormat('Y-m-d', $request->get('from'))->startOfDay();
            $query->where('created_at', '>=', $from);
        }

        if ($request->has('until')) {
            $until = \Carbon\Carbon::createFromFormat('Y-m-d', $request->get('until'))->endOfDay();
            $query->where('created_at', '<=', $until);
        }

        if ($request->has('customer_name')) {
            $query->where('customer.name', 'LIKE', '%' . $request->get('customer_name') . '%');
        }

        if ($request->has('customer_phone_number')) {
            $query->where('customer.phone_number', 'LIKE', '%' . $request->get('customer_phone_number') . '%');
        }
        if ($request->has('salesperson_entity_id')) {
            $query->where('salesPersonnel.entity.id', (int) $request->get('salesperson_entity_id'));
        }
        if ($request->has('customer_type')) {
            $query->where('customer.type', $request->get('customer_type'));
        }
        if ($request->has('payment_type')) {
            $query->where('payment_type', $request->get('payment_type'));
        }

        if ($request->get('validated') == 'true') {
            $query->whereNotNull('validated_at');
        }

        if ($request->has('delivery')) {
            if ($request->get('delivery') == 'null') {
                $query->whereNull('delivery');
            } else {
                $query->where('delivery', $request->get('delivery'));
            }
        }
        if ($request->get('status') == 'on_progress') {
            $query->whereNull('delivery.status');
        }elseif ($request->get('status') == 'completed_successfully') {
            $query->whereNotNull('delivery.handover_at')->where('delivery.status', true);
        }elseif ($request->get('status') == 'cancelled') {
            $query->whereNull('delivery.handover_at')->where('status', false);
        }

        $salesOrders = $query
                ->orderBy('id', $request->get('order', 'desc'))
                ->paginate((int) $request->get('paginate', 20));

        switch ($request->get('transformer')) {
            case 'simple':
                $this->transformer = new \Gelora\Sales\App\SalesOrder\Transformers\SalesOrderSimpleTransformer();
                break;
            default:
                break;
        }

        return $this->formatCollection($salesOrders, [], $salesOrders);
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

        $salesOrder->save();

        return $this->formatItem($salesOrder);
    }

    public function calculate($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);

        return response()->json(['data' => $salesOrder->calculate()->salesOrderBalance()]);
    }
}
