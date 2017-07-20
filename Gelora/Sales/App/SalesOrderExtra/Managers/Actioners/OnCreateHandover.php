<?php

namespace Gelora\Sales\App\SalesOrderExtra\Managers\Actioners;

use Gelora\Sales\App\SalesOrderExtra\SalesOrderExtraModel;

class OnCreateHandover {
    
    protected $salesOrderExtra;
    
    public function __construct(SalesOrderExtraModel $salesOrderExtra) {
        $this->salesOrderExtra = $salesOrderExtra;
    }
    
    public function action($receiverName) {
        
        $this->salesOrderExtra->setAttribute('handover', [
            'creator' => $this->salesOrderExtra->assignEntityData(),
            'receiver_name' => $receiverName
        ]);
        
        $this->salesOrderExtra->setAttribute('handover.created_at', \Carbon\Carbon::now());
        
        $this->salesOrderExtra->save();
    }
}
