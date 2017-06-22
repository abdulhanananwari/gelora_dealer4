<?php

namespace Gelora\Sales\Http\Controllers\Report;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;
use MongoDB\BSON\UTCDateTime;
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
                    'from' => 'units',
                    'localField' => 'unit_id',
                    'foreignField' => 'id',
                    'as' => 'unit'
                ]
            ], [
                '$unwind' => ['path' => '$unit', 'preserveNullAndEmptyArrays' => true]],
        ];
        if ($request->has('from')) {
            $from = new UTCDateTime(\Carbon\Carbon::createFromFormat('Y-m-d', $request->get('from'))->startOfDay()->getTimestamp() * 1000);
            $subquery = ['$match' => [$request->get('time_type') => ['$gte' => $from]]];
            $query[] = $subquery;
        }


        if ($request->has('until')) {
            $until = new UTCDateTime(\Carbon\Carbon::createFromFormat('Y-m-d', $request->get('until'))->endOfDay()->getTimestamp() * 1000);
            $subquery = ['$match' => [$request->get('time_type') => ['$lte' => $until]]];
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
            $subquery = ['$match' => ['leasingOrder.mainLeasing.id' => (int) $request->get('main_leasing_id')]];
            $query[] = $subquery;
        }

        if ($request->has('sub_leasing_id')) {
            $subquery = ['$match' => ['leasingOrder.subLeasing.id' => (int) $request->get('sub_leasing_id')]];
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

        if ($request->get('dashboard') == 'true') {
            
            return $this->formatData($this->transformer->transformCollection($salesOrders));
            
        } else {

            if (count($salesOrders) == 0) {
                return 'Tidak ada data penjualan untuk kriteria diatas';
            }
           
            return $this->createCsv($this->transformer->transformCollection($salesOrders));
        }
    }

}
