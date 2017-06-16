<?php

namespace Gelora\Sales\App\SalesOrderExtra\Managers\Calculators;

use Gelora\Sales\App\SalesOrderExtra\SalesOrderExtraModel;

class TotalBefVat {

    protected $salesOrderExtra;

    public function __construct(SalesOrderExtraModel $salesOrderExtra) {
        $this->salesOrderExtra = $salesOrderExtra;
    }

    public function calculate() {
        
        return $this->salesOrderExtra->quantity * $this->salesOrderExtra->price_per_unit;
        
    }
}
