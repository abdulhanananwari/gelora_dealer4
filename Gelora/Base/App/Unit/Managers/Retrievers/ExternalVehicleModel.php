<?php

namespace Gelora\Base\App\Unit\Managers\Retrievers;

use Gelora\Base\App\Unit\UnitModel;

class ExternalVehicleModel {

    protected $unit;

    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }

    public function retrieve() {
        
        $client = new \GuzzleHttp\Client();
        
        try {
            
            $res = $client->request('GET', env('VEHICLE_SERVER_DOMAIN') . 'api/model', [
                'query' => [
                    'code' => $this->unit->type_code
                ],
                'headers' => [
                    'Authorization' => 'Bearer ' . \ParsedJwt::getJwtString()
                ]
            ]);
            
            list($data) = json_decode($res->getBody()->getContents(), true)['data']; 
            
            return collect($data);
        
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            
            throw $e;
        
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            
            throw $e;
        }
        
    }

}
