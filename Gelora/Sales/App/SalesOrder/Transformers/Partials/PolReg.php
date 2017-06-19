<?php

namespace Gelora\Sales\App\SalesOrder\Transformers\Partials;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class PolReg {
    
    public static function transform (SalesOrderModel $salesOrder) {
        
        $polReg = $salesOrder->subDocument()->polReg();
        
        $transformed = [
            'items' => (array) $polReg->items,
            'costs' => (array) $polReg->costs,
            
            'strings' => (object) $polReg->strings,
            'generator' => (object) $polReg->generator,
            
            'md_submission_batch_id' => $polReg->md_submission_batch_id,
            'agency_submission_batch_id' => $polReg->agency_submission_batch_id,
            'agency_invoice_id' => $polReg->agency_invoice_id,
            'leasing_bpkb_submission_batch_id' => $polReg->leasing_bpkb_submission_batch_id,
        ];
        
        return $transformed;
    }
}
