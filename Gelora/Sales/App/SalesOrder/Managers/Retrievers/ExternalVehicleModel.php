<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Retrievers;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class ExternalVehicleModel {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function retrieve() {
        
        $client = new \GuzzleHttp\Client();
        
        try {
            
            $res = $client->request('GET', env('VEHICLE_SERVER_DOMAIN') . 'api/model', [
                'query' => [
                    'code' => $this->salesOrder->vehicle_code
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
