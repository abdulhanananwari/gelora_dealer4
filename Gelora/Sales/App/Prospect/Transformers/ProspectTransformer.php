<?php

namespace Gelora\Sales\App\Prospect\Transformers;

use League\Fractal;
use Gelora\Sales\App\Prospect\ProspectModel;

class ProspectTransformer extends Fractal\TransformerAbstract {

    public function transform(ProspectModel $prospect) {

        return [
            '_id' => $prospect->_id,
            'id' => $prospect->_id,
            
            'salesPersonnel' => (object) $prospect->salesPersonnel,
            
            'customer' => (object) $prospect->customer,
            'registration' => (object) $prospect->registration,
            'vehicle' => (object) $prospect->vehicle,
            'mediator' => (object) $prospect->mediator,
            
            'follow_ups' => (array) $prospect->follow_ups,
            
            'sales_condition' => $prospect->sales_condition,
            'payment_type' => $prospect->payment_type,
            'sales_note' => $prospect->sales_note,
            
            'discount' => (int) $prospect->discount,
            'mediator_fee' => (int) $prospect->mediator_fee,
            
            'created_at' => $prospect->created_at->toDateTimeString(),
            'creator' => $prospect->creator,
            
            'updated_at' => $prospect->updated_at->toDateTimeString(),
            'updater' => $prospect->updater,
            
            'reminders_sent' => (array) $prospect->reminders_sent,
                
            // Penutupan
            'closed_at' => $prospect->closed_at ? $prospect->closed_at->toDateTimeString() : null,
            'closer' => $prospect->closer,
            'closing_note' => $prospect->closing_note,
            'create_sales_order_request' => $prospect->create_sales_order_request ? (boolean) $prospect->create_sales_order_request : null,
            
            // Admin response
            'create_sales_order_response' => $prospect->create_sales_order_response ? (boolean) $prospect->create_sales_order_response : null,
            'create_sales_order_response_note' => $prospect->create_sales_order_response_note,
            'create_sales_order_responded_at' => $prospect->create_sales_order_responded_at ? $prospect->create_sales_order_responded_at->toDateTimeString() : null,
            'create_sales_order_responder' => $prospect->create_sales_order_responder,
            'sales_order_id' => $prospect->sales_order_id,
        ];
    }

}
