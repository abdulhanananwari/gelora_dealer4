<?php

namespace Gelora\Sales\App\SalesOrder\Transformers\Partials;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class LeasingOrder {
    
    public static function transform (SalesOrderModel $salesOrder) {
        
        $leasingOrder = $salesOrder->subDocument()->leasingOrder();
        
        $transformed = [
            'po_number' => $leasingOrder->po_number,
            
            'mainLeasing' => (object) $leasingOrder->mainLeasing,
            'subLeasing' => (object) $leasingOrder->subLeasing,
            
            'customer' => (object) $leasingOrder->customer,
            'registration' => (object) $leasingOrder->registration,
            'vehicle' => (object) $leasingOrder->vehicle,
            'on_the_road' => (int) $leasingOrder->on_the_road,
            'leasing_payable' => (int) $leasingOrder->leasing_payable,
            'dp_po' => (int) $leasingOrder->dp_po,
            'dp_bayar' => (int) $leasingOrder->dp_bayar,
            'tenor' => (int) $leasingOrder->tenor,
            'cicilan' => (int) $leasingOrder->cicilan,
            
            'note' => $leasingOrder->note,
            
            'po_file_uuid' => $leasingOrder->po_file_uuid,
            'memo_file_uuid' => $leasingOrder->memo_file_uuid,
            
            'due_uuid' => $leasingOrder->due_uuid,
            'joinPromos' => $leasingOrder->joinPromos ? (array) $leasingOrder->joinPromos : [],
            
            'invoice_generated_at' => $leasingOrder->toCarbon('invoice_generated_at') ? $leasingOrder->toCarbon('invoice_generated_at')->toDateTimeString() : null,
            'invoice_generator' => $leasingOrder->invoice_generator,

            'payment_transaction_uuid' => $leasingOrder->payment_transaction_uuid,
            'payment_at' => $leasingOrder->toCarbon('payment_at') ? $leasingOrder->toCarbon('payment_at')->toDateTimeString() : null,
            'payment_creator' => $leasingOrder->payment_creator,    
        ];
        
        return $transformed;
    }
}
