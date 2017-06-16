<?php

namespace Gelora\CreditSales\App\LeasingOrder\Transformers;

use League\Fractal;
use Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel;

class LeasingOrderTransformer extends Fractal\TransformerAbstract {
    
    protected $availableIncludes = ['leasing'];
    
    public function transform(LeasingOrderModel $leasingOrder) {
        
        return [
            'id' => $leasingOrder->_id,
            '_id' => $leasingOrder->_id,
            
            'po_number' => $leasingOrder->po_number,
            'leasing_id' => $leasingOrder->leasing_id,
            'sales_order_id' => $leasingOrder->sales_order_id,
            'pooling_id' => $leasingOrder->pooling_id ? (int) $leasingOrder->pooling_id : null,
            
            'mainLeasing' => $leasingOrder->mainLeasing,
            'subLeasing' => $leasingOrder->subLeasing,
            'customer' => $leasingOrder->customer,
            'registration' => $leasingOrder->registration,
            'vehicle' => $leasingOrder->vehicle,
            'on_the_road' => (int) $leasingOrder->on_the_road,
            'leasing_payable' => (int) $leasingOrder->leasing_payable,
            'dp_po' => (int) $leasingOrder->dp_po,
            'dp_bayar' => (int) $leasingOrder->dp_bayar,
            'tenor' => (int) $leasingOrder->tenor,
            'cicilan' => (int) $leasingOrder->cicilan,
            
            'note' => $leasingOrder->note,
            
            'po_file_uuid' => $leasingOrder->po_file_uuid,
            'memo_file_uuid' => $leasingOrder->memo_file_uuid,
            
            'applied_leasing_program_id' => $leasingOrder->applied_leasing_program_id,
            
            'due_uuid' => $leasingOrder->due_uuid,
            
            'creator' => $leasingOrder->creator,
            'created_at' => $leasingOrder->created_at->toDateTimeString(),
            
            'validation_required' => (bool) $leasingOrder->validation_required,
            'validated_at' => $leasingOrder->validated_at ? $leasingOrder->validated_at->toDateTimeString() : null,
            'validator' => $leasingOrder->validator,
            
            'invoice_generated_at' => $leasingOrder->invoice_generated_at ? $leasingOrder->invoice_generated_at->toDateTimeString() : null,
            'invoice_generator' => $leasingOrder->invoice_generator,
        ];
    }
   
    public function includeLeasing(LeasingOrderModel $leasingOrder) {
        
        $leasing = $leasingOrder->leasing;
        
        return $this->item($leasing,
                new \Gelora\CreditSales\App\Leasing\Transformers\LeasingTransformer(),
                'leasings');
    } 
}
