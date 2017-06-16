<?php

namespace Gelora\Base\Http\Controllers\Api\Price;

use Gelora\Base\Http\Controllers\Api\PriceController;
use Illuminate\Http\Request;

class SynchronizeController extends PriceController {

    public function __construct() {
        parent::__construct();
    }

    public function synchronize() {

        $client = new \GuzzleHttp\Client();

        $res = $client->get(env('VEHICLE_SERVER_DOMAIN') . 'api/model/', [
            'headers' => [
                'Authorization' => 'Bearer ' . \ParsedJwt::getJwtString(),
            ],
            'query' => [
                'current' => 'true',
            ]
        ]);
        
        // Deactivate all existing prices
        $this->price->where(true)->update(['model_current' => false], ['multi' => true]);
        
        $activeModels = collect(json_decode($res->getBody()->getContents(), true)['data']);
        $updatedPrices = new \Illuminate\Support\Collection;

        foreach ($activeModels as $activeModel) {

            $price = $this->price->where('model_id', (int) $activeModel['id'])->first();

            if (empty($price)) {
                $price = new $this->price;
            }

            $price->assign()->fromVehicleModel((object) $activeModel);
            $price->save();

            $updatedPrices->push($price);
        }

        return $this->formatCollection($updatedPrices);
    }

}
