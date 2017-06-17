<?php

namespace Gelora\CreditSales\App\LeasingOrder\Transformers;

use Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel;

class LeasingOrderReportTransformer {

    public function transformCollection(\Illuminate\Database\Eloquent\Collection $collection) {

        $transformeds = [];
        foreach ($collection as $data) {
            $transformeds[] = $this->transform($data);
        }
        return $transformeds;
    }
  
    
    public function transform(LeasingOrderModel $leasingOrder) {
        
        return [
            'id' => $leasingOrder->_id,
            '_id' => $leasingOrder->_id,
            
            'po_number' => $leasingOrder->po_number,
            
            'customer_name' => $leasingOrder['salesOrder']['customer']['name'],
            'registration_name' => $leasingOrder['salesOrder']['registration']['name'],
            'registration_address' => $leasingOrder['salesOrder']['registration']['address'],
            
            'main_leasing_name' => $leasingOrder->mainLeasing['name'],
            'sub_leasing_name' => $leasingOrder->subLeasing['name'],
            
            'vehicle_brand' => $leasingOrder['unit']['brand'],
            'vehicle_name' => $leasingOrder['unit']['type_name'],
            'vehicle_code' => $leasingOrder['unit']['type_code'],
            'vehicle_color' => $leasingOrder['unit']['color_name'],

            'vehicle_brand' => $leasingOrder['unit']['brand'],
            // 'vehicle_name' => $leasingOrder['unit']['type_name'],

            'on_the_road' => number_format($leasingOrder->on_the_road),
            'leasing_payable' => number_format($leasingOrder->leasing_payable),
            'dp_po' => number_format($leasingOrder->dp_po),
            'dp_bayar' => number_format($leasingOrder->dp_bayar),
            'tenor' => (int) $leasingOrder->tenor,
            'cicilan' => (int) $leasingOrder->cicilan,
            
            'note' => $leasingOrder->note,
           
            'creator_name' => $leasingOrder->creator['name'],
            
            'created_at' => $leasingOrder->created_at->toDateTimeString(),
            
            'validated_at' => $leasingOrder->validated_at ? $leasingOrder->validated_at->toDateTimeString() : null,
            
            'validator_name' => $leasingOrder->validator['name'],
            
            // 'invoice_generated_at' => $leasingOrder->invoice_generated_at ? $leasingOrder->invoice_generated_at->toDateTimeString() : null,
            'invoice_generator_name' => $leasingOrder->invoice_generator['name'],
        ];
    }

}
