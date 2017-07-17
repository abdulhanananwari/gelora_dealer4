<?php

namespace Gelora\Sales\App\SalesOrder\Transformers\Partials;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;
use MongoDB\BSON\ObjectID;

class PolReg {
    
    public static function transform (SalesOrderModel $salesOrder) {
        
        $polReg = $salesOrder->subDocument()->polReg();
        
        $transformed = [
            'agency_note' => $polReg->agency_note,
            
            'faktur_number' => $polReg->faktur_number,
            'pol_reg' => $polReg->pol_reg,
            'bpkb_number' => $polReg->bpkb_number,
            
            'items' => (array) $polReg->items,
            'costs' => (array) $polReg->costs,
            
            'strings' => (object) $polReg->strings,
            'generator' => (object) $polReg->generator,
            
            'md_submission_batch_id' => $polReg->md_submission_batch_id ? (string) (new ObjectID($polReg->md_submission_batch_id)) : null,
            'agency_submission_batch_id' => $polReg->agency_submission_batch_id ? (string) (new ObjectID($polReg->agency_submission_batch_id)) : null,
            'agency_invoice_id' => $polReg->agency_invoice_id ? (string) (new ObjectID($polReg->agency_invoice_id)) : null,
            'leasing_bpkb_submission_batch_id' => $polReg->leasing_bpkb_submission_batch_id ? (string) (new ObjectID($polReg->leasing_bpkb_submission_batch_id)) : null,
        ];
        
        return $transformed;
    }
}
