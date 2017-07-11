<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnUpdateAfterValidation {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {
        $mdSubmissionBatch = $this->salesOrder->getMdSubmissionBatch();
        if ($mdSubmissionBatch) {
            if ($mdSubmissionBatch->getAttribute('closed_at')) {
                return ['Batch untuk MD sudah ditutup , Data tidak dapat di edit lagi'];
            }
        }
       
       

        return true;
    }
}
