<?php

namespace Gelora\Base\App\Price\Transformers;

use Gelora\Base\App\Price\PriceModel;
use Solumax\PhpHelper\App\Transformers\ReportTransformer;

class PriceReportTransformer extends ReportTransformer {

    protected function transform(Array $price) {

        $array = [
            'model_id' => (int) $price['model_id'],
            
            'model_code' => (string) $price['model_code'],
            'model_name' => (string) $price['model_name'],
            'active' => (int) $this->getAttributeIfSet($price, 'model_current'),
            
            'plafond_group' => $this->getAttributeIfSet($price, 'plafond_group'),
            
            'cost_of_good' => (double) $this->getAttributeIfSet($price, 'cost_of_good'),
            'off_the_road' => (double) $this->getAttributeIfSet($price, 'off_the_road'),
            'on_the_road' => (double) $this->getAttributeIfSet($price, 'on_the_road'),
            'registration_fee' => (double) $this->getAttributeIfSet($price, 'registration_fee'),
            'max_registration_process_fee' => (double) $this->getAttributeIfSet($price, 'max_registration_process_fee'),
            
            'created_at' => (string) $price['created_at'],
            'updated_at' => (string) $price['updated_at'],
        ];

        return $array;
    }

}
