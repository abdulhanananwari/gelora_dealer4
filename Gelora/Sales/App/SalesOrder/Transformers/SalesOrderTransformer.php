<?php

namespace Gelora\Sales\App\SalesOrder\Transformers;

use League\Fractal;
use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class SalesOrderTransformer extends Fractal\TransformerAbstract {
    
    public function transform(SalesOrderModel $salesOrder) {
        
        $transformed = [
            'id' => $salesOrder->_id,
            '_id'=> $salesOrder->_id,
            
            'sales_note' => $salesOrder->sales_note,
            
            'customer' => (object) $salesOrder->customer,
            'registration' => (object) $salesOrder->registration,
            
            'vehicle'  => (object) $salesOrder->vehicle,
            'deliveryRequest' => (object) $salesOrder->deliveryRequest,
            'mediator' =>  (object) $salesOrder->mediator,
            'salesPersonnel' => (object) $salesOrder->salesPersonnel,
            
            'leasingOrder' => (object) $salesOrder->leasingOrder,

            
            'indent' => $salesOrder->indent,
            'plafond' => $salesOrder->plafond,
            
            'sales_condition' => $salesOrder->sales_condition,
            'payment_type' => $salesOrder->payment_type,
            
            'delivery_id' => $salesOrder->delivery_id,
            'delivery_assigner' => (object) $salesOrder->delivery_assigner,

            'registration_id' => $salesOrder->registration_id,
            
            // Time
            
            'created_at' => $salesOrder->created_at->toDateTimeString(),
            'creator' => $salesOrder->creator,
            
            'locked_at' => $salesOrder->locked_at ? $salesOrder->locked_at->toDateTimeString() : null,
            'locker_id' => $salesOrder->locker_id ? (int) $salesOrder->locker_id : null,
            
            'validated_at' => $salesOrder->validated_at ? $salesOrder->validated_at->toDateTimeString() : null,
            'validator' => $salesOrder->validator,
            'unvalidator' => $salesOrder->unvalidator,
            
            // Baru diisi setelah proses STNK selesai, pencairan leasing selesai, konsumen sudah bayar semua due.
            // Caranya sistem ngecheck jumlah diatas apakah sudah lengkap semua
            'financial_completed_at' => $salesOrder->financial_completed_at ? $salesOrder->financial_completed_at->toDateTimeString() : null,
            'financial_completer' => $salesOrder->financial_completer,
            
            // Udah selesai semua, ga ada sangkut paut lagi sama kita
            'closed_at' => $salesOrder->closed_at ? $salesOrder->closed_at->toDateTimeString() : null,
            'closer' => $salesOrder->closer,
            
            'delivery' => (object) $salesOrder->delivery
        ];
        
        $transformed['leasingOrder'] = Partials\LeasingOrder::transform($salesOrder);
        $transformed['cddb'] = Partials\Cddb::transform($salesOrder);
        
        return array_merge(
                $transformed,
                Partials\Price::transform($salesOrder)
        );
    }
}
