<?php

namespace Gelora\Sales\App\SalesOrderExtra\Managers\Actioners;

use Gelora\Sales\App\SalesOrderExtra\SalesOrderExtraModel;

class OnCreateOrUpdate {
    
    protected $salesOrderExtra;
    
    public function __construct(SalesOrderExtraModel $salesOrderExtra) {
        $this->salesOrderExtra = $salesOrderExtra;
    }
    
    public function action() {

        $this->salesOrderExtra->save();
    }
}
