<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners\Delivery;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;
use Solumax\PhpHelper\App\Mongo\SubDocument;

use MongoDB\BSON\UTCDateTime;

class OnHandover {
    
    protected $salesOrder;
    protected $delivery;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $this->delivery = new SubDocument();
        
        $this->delivery->handover_at = new UTCDateTime(\Carbon\Carbon::now()->timestamp * 1000);
        $this->delivery->handover_creator = $this->salesOrder->assignEntityData();

        if ($request->has('status')) {
            $this->delivery->status = (bool) $request->get('status');
        }

        $this->assignHandoverData($request);
        
        $this->salesOrder->delivery = $this->delivery;
        
        return $this->salesOrder;
        
            
    }
    
    protected function assignHandoverData($request){
    
          
        if ($this->delivery->status) {
            $keys = ['handover_name', 'handover_phone_number', 'handover_id_file_uuid',
                'handover_file_uuid', 'handover_lat', 'handover_lon', 'handover_note'];

        }else{
            $keys = ['handover_lat', 'handover_lon', 'handover_note'];
        }
        $this->delivery->fill($request->only($keys));
    }
}


