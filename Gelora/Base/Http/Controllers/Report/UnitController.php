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

        $query = $this->unit->newQuery();

        if ($request->has('from')) {
            $from = \Carbon\Carbon::createFromFormat('Y-m-d', $request->get('from'))->startOfDay();
            $query->where('created_at', '>=', $from);
        }

        if ($request->has('until')) {
            $until = \Carbon\Carbon::createFromFormat('Y-m-d', $request->get('until'))->endOfDay();
            $query->where('created_at', '<=', $until);
        }

        if ($request->has('no_sj')) {
            $query->where('no_sj', $request->get('no_sj'));
        }

        if ($request->has('no_nd')) {
            $query->where('no_nd', $request->get('no_nd'));
        }
        if ($request->has('current_status')) {
            $query->where('current_status', $request->get('current_status'));
        }
        if ($request->has('location_id')) {
            $query->where('location_id', $request->get('location_id'));
        }

        $units = $query->get();

        if (count($units) == 0) {
            return 'Tidak ada data penjualan untuk kriteria diatas';
        }

        $filename = 'units';

        $infoArray = $request->only('from', 'until', 'no_sj', 'no_nd');

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
