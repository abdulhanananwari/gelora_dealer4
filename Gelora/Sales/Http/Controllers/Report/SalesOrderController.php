<?php

namespace Gelora\Sales\Http\Controllers\Report;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;
use MongoDB\BSON\UTCDateTime;
use MongoDB\BSON\Regex;
use Solumax\PhpHelper\Http\ControllerExtensions\CsvParseAndCreate;

class SalesOrderController extends Controller {

    use CsvParseAndCreate;

    protected $transformer;

    public function __construct() {
        parent::__construct();

        $this->salesOrder = new \Gelora\Sales\App\SalesOrder\SalesOrderModel();
        $this->transformer = new \Gelora\Sales\App\SalesOrder\Transformers\SalesOrderReportTransformer();
    }

    public function index(Request $request) {

        $query = [
                [
                '$lookup' => [
                    'from' => 'leasing_orders',
                    'localField' => 'leasing_order_id',
                    'foreignField' => 'id',
                    'as' => 'leasing_order'
                ]
            ],
                [
                '$unwind' => [
                    'path' => '$leasing_order', 'preserveNullAndEmptyArrays' => true
                ]
            ],
                [
                '$lookup' => [
                    'from' => 'deliveries',
                    'localField' => 'delivery_id',
                    'foreignField' => 'id',
                    'as' => 'delivery'
                ]
            ],
                [
                '$unwind' => [
                    'path' => '$delivery', 'preserveNullAndEmptyArrays' => true
                ]
            ],
            [
                '$lookup' => [
                    'from' => 'units',
                    'localField' => 'delivery.unit_id',
                    'foreignField' => 'id',
                    'as' => 'unit'
                ]
            ],
                [
                '$unwind' => [
                    'path' => '$unit', 'preserveNullAndEmptyArrays' => true
                ]
            ],
                [
                '$lookup' => [
                    'from' => 'registrations',
                    'localField' => 'registration_id',
                    'foreignField' => 'id',
                    'as' => 'usedRegistration'
                ]
            ],
                [
                '$unwind' => [
                    'path' => '$usedRegistration', 'preserveNullAndEmptyArrays' => true
                ]
            ],
                
        ];
        if ($request->has('delivery_from')) {

            $deliveryFrom = new UTCDateTime(\Carbon\Carbon::createFromFormat('Y-m-d', $request->get('delivery_from'))->startOfDay()->getTimestamp() * 1000);
            $subquery = ['$match' => ['delivery.handover_at' => ['$gte' => $deliveryFrom]]];
            $query[] = $subquery;
        }


        if ($request->has('delivery_until')) {

            $deliveryUntil = new UTCDateTime(\Carbon\Carbon::createFromFormat('Y-m-d', $request->get('delivery_until'))->endOfDay()->getTimestamp() * 1000);

            $subquery = ['$match' => ['delivery.handover_at' => ['$lte' => $deliveryUntil]]];
            $query[] = $subquery;
        }

        if ($request->has('sales_order_from')) {

            $salesOrderFrom = new UTCDateTime(\Carbon\Carbon::createFromFormat('Y-m-d', $request->get('sales_order_from'))->startOfDay()->getTimestamp() * 1000);

            $subquery = ['$match' => ['created_at' => ['$gte' => $salesOrderFrom]]];
            $query[] = $subquery;
        }

        if ($request->has('sales_order_until')) {

            $salesOrderUntil = new UTCDateTime(\Carbon\Carbon::createFromFormat('Y-m-d', $request->get('sales_order_until'))->endOfDay()->getTimestamp() * 1000);

            $subquery = ['$match' => ['created_at' => ['$lte' => $salesOrderUntil]]];
            $query[] = $subquery;
        }

        if ($request->has('type_name')) {
            $subquery = ['$match' => ['unit.type_name' => $request->get('type_name')]];
            $query[] = $subquery;
        }

        if ($request->has('color_name')) {
            $subquery = ['$match' => ['unit.color_name' => $request->get('color_name')]];
            $query[] = $subquery;
        }

        if ($request->has('main_leasing_id')) {
            $subquery = ['$match' => ['leasing_order.mainLeasing.id' => (int) $request->get('main_leasing_id')]];
            $query[] = $subquery;
        }

        if ($request->has('sub_leasing_id')) {
            $subquery = ['$match' => ['leasing_order.subLeasing.id' => (int) $request->get('sub_leasing_id')]];
            $query[] = $subquery;
        }

        if ($request->has('sales_personnel_id')) {
            $subquery = ['$match' => ['salesPersonnel.entity.id' => (int) $request->get('sales_personnel_id')]];
            $query[] = $subquery;
        }

        if ($request->has('payment_type')) {
            $subquery = ['$match' => ['payment_type' => $request->get('payment_type')]];
            $query[] = $subquery;
        }
        if ($request->has('customer_type')) {
            $subquery = ['$match' => ['customer.type' => $request->get('customer_type')]];
            $query[] = $subquery;
        }

        $salesOrders = $this->salesOrder->raw(function($collection) use ($query) {
            return $collection->aggregate(
                            $query
            );
        });

        // return response()->json($salesOrders);

        if (count($salesOrders) == 0) {
            return 'Tidak ada data penjualan untuk kriteria diatas';
        }
        //return response()->json($salesOrders);

        return $this->createCsv($this->transformer->transformCollection($salesOrders));
    }

}
