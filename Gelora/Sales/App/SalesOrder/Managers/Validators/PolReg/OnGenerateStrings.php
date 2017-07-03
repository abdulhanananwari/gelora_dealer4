<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\PolReg;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnGenerateStrings {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function validate() {
        
        if (!is_null($this->salesOrder->getMdSubmissionBatch()->closed_at)) {
            return ['Batch untuk MD sudah ditutup'];
        }
        
        if (empty($this->salesOrder->cddb)) {
            return ['String CDDB belum dibuat'];
        }
        
        return true;
    }
}
