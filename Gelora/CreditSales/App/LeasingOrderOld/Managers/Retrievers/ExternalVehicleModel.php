<?php

namespace Gelora\CreditSales\App\LeasingOrder\Managers\Retrievers;

use Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel;

class ExternalVehicleModel {
    
    protected $LeasingOrder;
    
    public function __construct(LeasingOrderModel $LeasingOrder) {
        $this->leasingOrder = $LeasingOrder;
    }
    
    public function retrieve() {
        
        $client = new \GuzzleHttp\Client();
        
        try {
            
            $res = $client->request('GET', env('VEHICLE_SERVER_DOMAIN') . 'api/model', [
                'query' => [
                    'code' => $this->leasingOrder->vehicle->code
                ],
                'headers' => [
                    'Authorization' => 'Bearer ' . \ParsedJwt::getJwtString()
                ]
            ]);
            
            list($data) = json_decode($res->getBody()->getContents(), true)['data']; 
            
            return (object) $data;
        
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            
            throw $e;
        
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            
            throw $e;
        }
        
    }
}
