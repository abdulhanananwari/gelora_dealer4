<?php

namespace Gelora\CreditSales\App\Leasing\Transformers\Partials;

use \Gelora\CreditSales\App\Leasing\LeasingModel;

class LeasingPersonnels {

    public static function transformCollection(LeasingModel $leasing) {
        $transformeds = [];
        foreach((array) $leasing->getAttribute('leasingPersonnels') as $leasingPersonnel) {
            $transformeds[] = self::transform($leasingPersonnel);
        }
        return $transformeds;
    }

    public static function transform($leasingPersonnel) {
        
        $subDoc = new \Solumax\PhpHelper\App\Mongo\SubDocument($leasingPersonnel);
        
        return [
            'id' => (int) $subDoc->get('id'),
            'name' => $subDoc->get('name'),
            'email' => $subDoc->get('email'),
            'access' => (object) $subDoc->get('access'),
        ];
    }

}
