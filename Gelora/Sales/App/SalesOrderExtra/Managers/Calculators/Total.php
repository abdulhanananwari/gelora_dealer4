<?php

namespace Gelora\Sales\App\SalesOrderExtra\Managers\Calculators;

use Gelora\Sales\App\SalesOrderExtra\SalesOrderExtraModel;

class Total {

    protected $salesOrderExtra;

    public function __construct(SalesOrderExtraModel $salesOrderExtra) {
        $this->salesOrderExtra = $salesOrderExtra;
    }

    public function calculate() {
        
       $this->salesOrderExtra->total = ($this->salesOrderExtra->quantity * $this->salesOrderExtra->price_per_unit) - $this->salesOrderExtra->vat;

       return $this->salesOrderExtra->total;
        
    }
}
