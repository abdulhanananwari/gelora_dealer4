<?php

namespace Gelora\Base\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class SalesExtraController extends Controller {

    protected $salesExtra;

    public function __construct() {
        parent::__construct();
        $this->salesExtra = new \Gelora\Base\App\SalesExtra\SalesExtraModel();

        $this->transformer = new \Gelora\Base\App\SalesExtra\Transformers\SalesExtraTransformer();
        $this->dataName = 'sales_extras';
    }

    public function index(Request $request) {

        $query = $this->salesExtra->newQuery();

        $salesExtras = $query->get();

        return $this->formatCollection($salesExtras);
    }

    public function get($id, Request $request) {

        $salesExtra = $this->salesExtra->find($id);

        return $this->formatItem($salesExtra);
    }

    public function store(Request $request) {

        $salesExtra = $this->salesExtra->assign()->fromRequest($request);

        $salesExtra->save();

        return $this->formatItem($salesExtra);
    }

    public function update($id, Request $request) {

        $salesExtra = $this->salesExtra->find($id);
        $salesExtra->assign()->fromRequest($request);

        $salesExtra->save();

        return $this->formatItem($salesExtra);
    }

}
