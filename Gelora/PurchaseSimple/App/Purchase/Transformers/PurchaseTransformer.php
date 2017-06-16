<?php

namespace Gelora\PurchaseSimple\App\Purchase;

use League\Fractal;
use Gelora\PurchaseSimple\App\Purchase\PurchaseModel;

class PurchaseTransformer extends Fractal\TransformerAbstract {
    
    public function transform(PurchaseModel $purchase) {
        
        return [
            'id' => $purchase->id,
            
            'note' => $purchase->note,
            'vendor' => (object) $purchase->vendor,
            
            'created_at' => $purchase->created_at->toDateTimeString(),
            'closed_at' => $purchase->closed_at ? $purchase->closed_at->toDateTimeString() : null,
        ];
    }
}
