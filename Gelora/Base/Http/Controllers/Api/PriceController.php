<?php

namespace Gelora\Base\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;
use Gelora\Base\Http\Controllers\Api\Price\CurrentPrice;

class PriceController extends Controller {

    use CurrentPrice;

    protected $price;

    public function __construct() {
        parent::__construct();
        $this->price = new \Gelora\Base\App\Price\PriceModel();

        $this->transformer = new \Gelora\Base\App\Price\Transformers\PriceTransformer();
        $this->dataName = 'prices';
        
        switch (request()->get('transformer')) {
            case 'PricePlafondGroupTransformer':
                $this->transformer = new \Gelora\Base\App\Price\Transformers\PricePlafondGroupTransformer();
                break;
            default:
                break;
        }
    }

    public function index(Request $request) {

        $query = $this->price->newQuery();

        if ($request->has('model_ids')) {
            
            $modelIds = [];
            foreach (explode(',', $request->get('model_ids')) as $id) {
                $modelIds[] = (int) $id;
            }
            $query->whereIn('model_id', $modelIds);
        }

        if ($request->has('model_codes')) {
            $query->whereIn('model_code', explode(',', $request->get('model_codes')));
        }
        
        if ($request->get('transformer') == 'PricePlafondGroupTransformer') {
            $query->whereNotNull('plafond_group')->groupBy('plafond_group')->select('plafond_group');
        }
        
        $prices = $query->orderBy('model_id', 'desc')->get();

        return $this->formatCollection($prices);
    }

    public function get($id) {

        $price = $this->price->where('model_id', (int) $id)->first();

        return $this->formatItem($price);
    }

    public function store(Request $request) {

        $price = $this->price->assign()->fromRequestOnCreate($request);

        $validation = $price->validate()->onCreate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $price->action()->onCreate();

        return $this->formatItem($price);
    }

    public function update($id, Request $request) {

        $price = $this->price->where('model_id', (int) $id)->first();
        $price->assign()->fromRequestOnUpdate($request);

        $validation = $price->validate()->onUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $price->action()->onCreate();

        return $this->formatItem($price);
    }

}
