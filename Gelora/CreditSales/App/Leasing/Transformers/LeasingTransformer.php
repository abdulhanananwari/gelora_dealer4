<?php

namespace Gelora\CreditSales\App\Leasing\Transformers;

use League\Fractal;
use Gelora\CreditSales\App\Leasing\LeasingModel;

class LeasingTransformer extends Fractal\TransformerAbstract {

    public function transform(LeasingModel $leasing) {

        return [
            'id' => $leasing->_id,
            
            'code' => $leasing->code,
            
            'mainLeasing' => $leasing->mainLeasing,
            'subLeasings' => $leasing->subLeasings,

            'generateDocuments' => $leasing->generateDocuments,

            'created_at' => $leasing->created_at->toDateTimeString(),
        ];
    }

}
