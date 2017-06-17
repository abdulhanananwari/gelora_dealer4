<?php

namespace Gelora\CreditSales\App\LeasingOrder\Transformers;

use League\Fractal;
use Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel;

class LeasingOrderFinancialTransformer extends Fractal\TransformerAbstract {
    
    public function transform(LeasingOrderModel $leasingOrder) {
        
        $leasingOrderTransformer = new LeasingOrderTransformer();
        $defaultTransform = $leasingOrderTransformer->transform($leasingOrder);
        
        // Penambahan field financial
        $defaultTransform['financial'] = $leasingOrder->financial;
        
        return $defaultTransform;
    }
   
}
