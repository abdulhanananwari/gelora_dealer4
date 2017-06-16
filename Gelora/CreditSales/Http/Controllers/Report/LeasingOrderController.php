<?php

namespace Gelora\CreditSales\Http\Controllers\Report;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as controller;
use Illuminate\Http\Request;
use MongoDB\BSON\UTCDateTime;
use MongoDB\BSON\Regex;
use Solumax\PhpHelper\Http\ControllerExtensions\CsvParseAndCreate;

class LeasingOrderController extends Controller{
    use CsvParseAndCreate;
    protected $transformer;
    public function __construct(){
        parent::__construct();
        
        $this->leasingOrder = new \Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel();
        $this->transformer = new \Gelora\CreditSales\App\LeasingOrder\Transformers\LeasingOrderReportTransformer();
        
    }
    public function index(Request $request) {
        $query = [
            [
                '$lookup' => [
                    'from' => 'sales_orders',
                    'localField' => 'sales_order_id',
                    'foreignField' => 'id',
                    'as' => 'sales_order'
                ]
            ],
            ['$unwind' =>['path'=>'$sales_order', 'preserveNullAndEmptyArrays' => true]],
            [
                '$lookup' => [
                    'from' => 'deliveries',
                    'localField' => 'sales_order.delivery_id',
                    'foreignField' => 'id',
                    'as' => 'delivery'
                ]
            ],
            ['$unwind' =>['path'=>'$delivery', 'preserveNullAndEmptyArrays' => true]],
            [
                '$lookup' => [
                    'from' => 'units',
                    'localField' => 'delivery.unit_id',
                    'foreignField' => 'id',
                    'as' => 'unit'
                ]
            ],
            ['$unwind' =>['path'=>'$unit', 'preserveNullAndEmptyArrays' => true]],
            
        ];
        if ($request->has('from')) {
            $from = new UTCDateTime(\Carbon\Carbon::createFromFormat('Y-m-d', $request->get('from'))->startOfDay()->getTimestamp() * 1000);
            $subquery = ['$match' => ['created_at' => ['$gte' => $from]]];
            $query[] = $subquery; 
        }
        if ($request->has('until')) {
            $until = new UTCDateTime(\Carbon\Carbon::createFromFormat('Y-m-d', $request->get('until'))->endOfDay()->getTimestamp() * 1000);
            $subquery = ['$match' => ['created_at' => ['$lte' => $until]]];
            $query[] = $subquery; 
        }
        if($request->has('type_name')){
        
            $subquery = ['$match' => ['unit.type_name' => $request->get('type_name')]];
            $query[]=$subquery;
        }
       
        if($request->has('main_leasing_id')) {
            $subquery = ['$match' => ['mainLeasing.id' => (int) $request->get('main_leasing_id')]];
            $query[]=$subquery;
        }
        if($request->has('sub_leasing_id')) {
            $subquery = ['$match' => ['subLeasing.id' => (int) $request->get('sub_leasing_id')]];
            $query[]=$subquery;
        }
        $leasingOrders = $this->leasingOrder->raw(function($collection) use ($query){
        
            return $collection->aggregate(
                    $query);
        });

        //return response()->json($this->transformer->transformCollection($leasingOrders));

        //return response()->json($leasingOrders);
        return $this->createCsv($this->transformer->transformCollection($leasingOrders));
    }
}