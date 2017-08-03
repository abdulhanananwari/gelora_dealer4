<?php

namespace Gelora\Sales\App\SalesOrder\Transformers\Partials\LeasingOrder;

use \Solumax\PhpHelper\App\Mongo\SubDocument;
use MongoDB\BSON\UTCDateTime;

class JoinPromo {
    
    public static function transform(SubDocument $joinPromoSubdocument) {
        
        $data = [
            'name' => $joinPromoSubdocument->name,
            'amount' => (int) $joinPromoSubdocument->amount,
            'transfer_amount' => (int) $joinPromoSubdocument->transfer_amount,
            'calculated_transfer_amount' => (int) $joinPromoSubdocument->calculated_transfer_amount,
            'due_day_type' => $joinPromoSubdocument->due_day_type,
            'due_day_count' => (int) $joinPromoSubdocument->due_day_count,
        ];

        if ($joinPromoSubdocument->getAttribute('transaction.id')) {
            
            $transaction = [
                'id' => $joinPromoSubdocument->get('transaction.id'),
                'uuid' => $joinPromoSubdocument->get('transaction.uuid'),
                'amount' => (int) $joinPromoSubdocument->get('transaction.amount'),
                'creator' => $joinPromoSubdocument->get('transaction.creator'),
                'created_at' => $joinPromoSubdocument->toCarbon('transaction.created_at')->toDateTimeString(),
            ];
            
            $data['transaction'] = $transaction;
        }
        
        return $data;
    }
}
