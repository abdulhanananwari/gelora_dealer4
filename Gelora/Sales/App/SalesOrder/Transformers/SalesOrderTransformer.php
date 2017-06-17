<?php

namespace Gelora\Sales\App\SalesOrder\Transformers;

use League\Fractal;
use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class SalesOrderTransformer extends Fractal\TransformerAbstract {
//    
//    public $availableIncludes = ['leasingOrders', 'selectedLeasingOrder','usedRegistration',
//        'salesOrderExtras', 'cddb', 'price', 'financialBalance'];
    public $defaultIncludes = ['unit'];

    public function transform(SalesOrderModel $salesOrder) {
        
        $transformed = [
            'id' => $salesOrder->_id,
            '_id'=> $salesOrder->_id,
            
            'sales_note' => $salesOrder->sales_note,
            
            'customer' => (object) $salesOrder->customer,
            'registration' => (object) $salesOrder->registration,
            
            'vehicle'  => (object) $salesOrder->vehicle,
            'delivery_request' => (object) $salesOrder->delivery_request,
            'mediator' =>  (object) $salesOrder->mediator,
            'salesPersonnel' => (object) $salesOrder->salesPersonnel,

            
            'indent' => $salesOrder->indent,
            'plafond' => $salesOrder->plafond,
            
            'kondisi_jual' => $salesOrder->sales_condition,

            'sales_condition' => $salesOrder->sales_condition,
            'payment_type' => $salesOrder->payment_type,
            
            'leasing_order_id' => $salesOrder->leasing_order_id,
            'leasing_order_selector' => $salesOrder->leasing_order_selector,
            
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
            
            'delivery' => (object) $salesOrder->delivery,
            'unit_id' => $salesOrder->unit_id,
        ];
        
        return array_merge(
                $transformed,
                Partials\Price::transform($salesOrder)
        );
    }


    public function includeUnit(SalesOrderModel $salesOrder) {

        if (is_null($salesOrder->unit_id)) {
            return null;
        }

        $unit = $salesOrder->unit;

        return $this->item($unit,
                new \Gelora\Base\App\Unit\Transformers\UnitTransformer(),
                'units');
    }
//    
//    public function includeLeasingOrders(SalesOrderModel $salesOrder) {
//
//        $leasingOrders = $salesOrder->leasingOrders;
//        
//            
//        return $this->collection($leasingOrders,
//                new \Gelora\CreditSales\App\LeasingOrder\Transformers\LeasingOrderTransformer(),
//                'leasing_orders');
//    }
//    
//    public function includeSelectedLeasingOrder(SalesOrderModel $salesOrder) {
//        
//        if (is_null($salesOrder->leasing_order_id)) {
//            return null;
//        }
//        
//        $leasingOrder = $salesOrder->selectedLeasingOrder;
//        
//        return $this->item($leasingOrder,
//                new \Gelora\CreditSales\App\LeasingOrder\Transformers\LeasingOrderTransformer(),
//                'leasing_order');
//    }
//    
//    public function includeSalesOrderExtras(SalesOrderModel $salesOrder) {
//        
//        $salesOrderExtras = $salesOrder->salesOrderExtras;
//
//        return $this->collection($salesOrderExtras,
//                new \Gelora\Sales\App\SalesOrderExtra\Transformers\SalesOrderExtraTransformer(),
//                'sales_order_extras');
//    }
//    
//    public function includeCddb(SalesOrderModel $salesOrder) {
//        
//        $cddb = $salesOrder->cddb;
//        
//        if (empty($cddb)) {
//            return null;
//        }
//        
//        return $this->item($cddb,
//                new \Gelora\Cdb\App\Cddb\Transformers\CddbTransformer(),
//                'cddb');
//    }
//    
//    public function includePrice(SalesOrderModel $salesOrder) {
//        
//        if (is_null($salesOrder->price)) {
//            return null;
//        }
//        
//        $price = $salesOrder->price;
//        
//        return $this->item($price,
//                new \Gelora\Base\App\Price\Transformers\PriceTransformer(),
//                'prices');
//    }
//    
//    public function includeFinancialBalance(SalesOrderModel $salesOrder) {
//        
//        return $this->item($salesOrder,
//                new Partials\FinancialBalance(),
//                'financialBalance');
//    }
//    
//    public function includeUsedRegistration(SalesOrderModel $salesOrder) {
//        
//        if (is_null($salesOrder->registration_id)) {
//            return null;
//        }
//        
//        $usedRegistration = $salesOrder->usedRegistration;
//        
//        return $this->item($usedRegistration,
//                new \Gelora\PolReg\App\Registration\Transformers\RegistrationTransformer(),
//                'registrations');
//    }
//    
    
}
