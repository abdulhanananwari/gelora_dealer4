<?php

namespace Gelora\Base\Http\Controllers\Report;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;
use Solumax\PhpHelper\Http\ControllerExtensions\CsvParseAndCreate;

class PriceController extends Controller {

    use CsvParseAndCreate;

    protected $price;
    protected $transformer;

    public function __construct() {
        parent::__construct();
        $this->price = new \Gelora\Base\App\Price\PriceModel();
        
        $this->transformer = new \Gelora\Base\App\Price\Transformers\PriceReportTransformer;
        $this->dataName = 'prices';
    }

    public function index(Request $request) {
        
        $query = $this->price->newQuery();
        
        if ($request->get('current_model_only') == 'true') {
            $query->where('model.current', true);
        }
        
        $prices = $query->get();
        
        foreach ($prices as $price) {
            unset($price['model']);
        }
        
        $formattedData = $this->transformer->transformCollection($prices->toArray());
        
        return $this->createCsv($formattedData);
    }

}
