<?php

namespace Gelora\Base\Http\Controllers\Api\Price;

use Gelora\Base\Http\Controllers\Api\PriceController;
use Illuminate\Http\Request;

class PriceExtensiveController extends PriceController {

    public function __construct() {
        parent::__construct();
        $this->transformer = new \Gelora\Base\App\Price\Transformers\PriceExtensiveTransformer();
    }
}
