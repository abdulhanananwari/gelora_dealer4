<?php

namespace Gelora\Sales\App\SalesOrderExtra\Transformers\Partials;

use Gelora\Sales\App\SalesOrderExtra\SalesOrderExtraModel;

class Handover {
    
    public static function transform(SalesOrderExtraModel $salesOrderExtra) {
        
        return [
            'created_at' => $salesOrderExtra->getAttribute('handover.created_at') ? $salesOrderExtra->getAttribute('handover.created_at')->toDateTimeString() : null,
            'creator' => (object) $salesOrderExtra->getAttribute('handover.creator'),
            'receiver_name' => $salesOrderExtra->getAttribute('handover.receiver_name'),
        ];
    }
}
