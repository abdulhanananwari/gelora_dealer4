<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\PolReg;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnRemoveBatch {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function validate($batch) {

        $key = array_keys($batch)[0];

        switch ($key) {
            case 'md_submission_batch_id':
            $mdSubmissionBatch = $this->salesOrder->getMdSubmissionBatch();
            if ($mdSubmissionBatch->closed_at) {
                return ['Tidak bisa merubah batch karena sudah ditutup'];
            }
            break;
        }
        
        return true;
    }
}
