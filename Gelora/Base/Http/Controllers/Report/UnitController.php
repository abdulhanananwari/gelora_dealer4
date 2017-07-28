<?php

namespace Gelora\Base\Http\Controllers\Report;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;
use Solumax\PhpHelper\Http\ControllerExtensions\CsvParseAndCreate;

class UnitController extends Controller {

    use CsvParseAndCreate;

    protected $transformer;

    public function __construct() {
        parent::__construct();
        $this->unit = new \Gelora\Base\App\Unit\UnitModel();

        $this->transformer = new \Gelora\Base\App\Unit\Transformers\UnitReportTransformer();
    }

    public function index(Request $request) {

        $query = $this->unit->queryBuilder()->build($request);

        $units = $query->get();

        if (count($units) == 0) {
            return 'Tidak ada data penjualan untuk kriteria diatas';
        }

        $filename = 'units';

        $infoArray = $request->except('jwt');
        
        $outputBuffer = $this->initializeCsv($filename);

        $this->createHeader($infoArray, $outputBuffer);
        $this->pushCsvLine($infoArray, $outputBuffer);

        $this->pushCsvLine([], $outputBuffer);

        $unitsArray = $this->transformer->transform($units);

        $this->createHeader($unitsArray[0], $outputBuffer);
        $this->pushData($unitsArray, $outputBuffer);

        return $this->getCsv($outputBuffer);
    }

}
