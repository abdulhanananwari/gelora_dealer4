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

        if (request()->has('transformer')) {
            $transformer = '\\Gelora\\Sales\\App\\SalesOrder\\Transformers\\' . request()->get('transformer');
            $this->transformer = new $transformer;
        }
    }

    public function index(Request $request) {

        $query = $this->salesOrder->newQuery();

        if ($request->has('sales_personnel_access')) {
            if ($request->get('sales_personnel_access')['team']) {
                $query->where('salesPersonnel.team_id', $request->get('sales_personnel_access')['team']['id']);
            } else if ($request->get('sales_personnel_access')['personnel']) {
                $query->where('salesPersonnel.id', $request->get('sales_personnel_access')['personnel']['id']);
            }
        }

        if ($request->has('from')) {
            $from = \Carbon\Carbon::createFromFormat('Y-m-d', $request->get('from'))->startOfDay();
            $query->where($request->get('time_type', 'created_at'), '>=', $from);
        }

        if ($request->has('until')) {
            $until = \Carbon\Carbon::createFromFormat('Y-m-d', $request->get('until'))->endOfDay();
            $query->where($request->get('time_type', 'created_at'), '<=', $until);
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

        if ($request->has('status')) {
            switch ($request->get('status')) {
                case 'validated':
                    $query->whereNotNull('validated_at');
                    break;
                case 'delivery_generated':
                    $query->whereNotNull('delivery.generated_at');
                    break;
                case 'delivery_handover_created':
                    $query->whereNotNull('delivery.handover.created_at');
                    break;
                case 'financial_completed':
                    $query->whereNotNull('financial_completed_at');
                    break;
                default;
                    break;
            }
        }

        $query->orderBy($request->get('order_by', 'created_at'), $request->get('order', 'desc'));

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

        $salesOrder->save();

        return $this->formatItem($salesOrder);
    }

    public function calculate($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);

        return response()->json(['data' => $salesOrder->calculate()->salesOrderBalance()]);
    }

}
