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
    }

    public function index(Request $request) {

        $query = $this->salesOrder->newQuery();
        $query = $this->salesOrder->queryBuilder()->build($query, $request);

        $salesOrders = $query->get();
        
        $this->transformer = new \Gelora\Sales\App\SalesOrder\Transformers\SalesOrderReportTransformer($request->get('fields'));

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
