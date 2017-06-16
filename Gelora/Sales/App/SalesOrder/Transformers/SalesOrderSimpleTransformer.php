<?php

namespace Gelora\Sales\App\SalesOrder\Transformers;

use League\Fractal;
use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class SalesOrderSimpleTransformer extends Fractal\TransformerAbstract {
    
    public function transform(SalesOrderModel $salesOrder) {
        
        return [
            'id' => $salesOrder->_id,
            '_id' => $salesOrder->_id,
            'uuid' => $salesOrder->uuid,
            
            'creator_id' => (int) $salesOrder->creator_id,
            'customer' => $salesOrder->customer,
            'vehicle' => $salesOrder->vehicle,
            'registration' => $salesOrder->registration,
            'salesPersonnel' => $salesOrder->salesPersonnel,
            'sales_condition' => $salesOrder->sales_condition,
            'payment_type' => $salesOrder->payment_type,
            
            'on_the_road' => (int) $salesOrder->on_the_road,
            'off_the_road' => (int) $salesOrder->off_the_road,
            'registration_fee' => (int) $salesOrder->registration_fee,
            
            'discount' => (int) $salesOrder->discount,
            'discount_leasing' => (int) $salesOrder->discount_leasing,
            'total_discount' => (int) $salesOrder->total_discount,
            
            'locked_at' => $salesOrder->locked_at ? $salesOrder->locked_at->toDateTimeString() : null,
            'locker_id' => $salesOrder->locker_id ? (int) $salesOrder->locker_id : null,
            
            'validated_at' => $salesOrder->validated_at ? $salesOrder->validated_at->toDateTimeString() : null,
            'validator_id' => $salesOrder->validator_id ? (int) $salesOrder->validator_id : null,
            
            'created_at' => $salesOrder->created_at->toDateTimeString(),
        ];
    }
    
}
