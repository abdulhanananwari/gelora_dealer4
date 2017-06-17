<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners\Delivery;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

use MongoDB\BSON\UTCDateTime;

class OnHandover {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $delivery = new \stdClass();
        
        $delivery->handover_at = new UTCDateTime(\Carbon\Carbon::now()->timestamp * 1000);
        $delivery->handover_creator = $this->salesOrder->assignEntityData();
       
        $delivery->status = $request->get('status');
       
       // $this->assignHandoverData($request);
        
        $this->salesOrder->delivery = $delivery;
        
        return $this->salesOrder;
        
            
    }
    
    protected function assignHandoverData($request){
        
        $delivery = new \stdClass();
          
        if ($delivery->status) {
            $keys = ['handover_name', 'handover_phone_number', 'handover_id_file_uuid',
                'handover_file_uuid', 'handover_lat', 'handover_lon', 'handover_note'];

            $delivery->fill($request->only($keys));
        }else{
            $keys = ['handover_lat', 'handover_lon', 'handover_note'];

            $delivery->fill($request->only($keys));
        }
        $this->salesOrder->delivery = $delivery;
    }
}


