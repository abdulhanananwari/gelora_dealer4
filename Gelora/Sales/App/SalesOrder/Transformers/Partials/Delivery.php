<?php

namespace Gelora\Sales\App\SalesOrder\Transformers\Partials;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Delivery {
    
    public static function transform (SalesOrderModel $salesOrder) {
        
        $delivery = $salesOrder->subDocument()->delivery();
        
        $transformed = [

            'status_for_human' => $delivery->generateStatus()->statusForHuman(),
            
            'handover_lat' => $delivery->handover_lat ? (double) $delivery->handover_lat : null,
            'handover_lon' => $delivery->handover_lon ? (double) $delivery->handover_lon : null,
            'handover_note' => $delivery->handover_note,
            'handover_at' => $delivery->handover_at ? $delivery->handover_at->toDateTimeString() : null,
            'handover_creator_id' => $delivery->handover_creator_id ? (int) $delivery->handover_creator_id : null,
            
            'handover_name' => $delivery->handover_name,
            'handover_phone_number' => $delivery->handover_phone_number,
            'handover_id_file_uuid' => $delivery->handover_id_file_uuid,
            'handover_file_uuid' => $delivery->handover_file_uuid,
            
        ];
        
        return $transformed;
    }
}
