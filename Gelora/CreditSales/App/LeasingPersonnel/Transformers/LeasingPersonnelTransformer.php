<?php

namespace Gelora\CreditSales\App\LeasingPersonnel\Transformers;

use League\Fractal;
use Gelora\CreditSales\App\LeasingPersonnel\LeasingPersonnelModel;

class LeasingPersonnelTransformer extends Fractal\TransformerAbstract {
    
    public function transform(LeasingPersonnelModel $leasingPersonnel) {
        
        return [
            'id' => $leasingPersonnel->_id,
            '_id' => $leasingPersonnel->_id,

            'leasing' => $leasingPersonnel->leasing,
            'user' => $leasingPersonnel->user,
            'access' => $leasingPersonnel->access,
        ];
        
    }

    public function includeLeasing(LeasingPersonnelModel $leasingPersonnel) {
    	$leasing = $leasingPersonnel->leasing;

    	return $this->item($leasing,
    		new \Gelora\CreditSales\App\Leasing\Transformers\LeasingTransformer);
    }
}
