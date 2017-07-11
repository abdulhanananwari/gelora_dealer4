<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\Specific;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Registration {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {

        $mdSubmissionBatch = $this->salesOrder->getMdSubmissionBatch();
        if ($mdSubmissionBatch && $mdSubmissionBatch->getAttribute('closed_at') != null) {
            return ['Batch untuk MD sudah ditutup , Data tidak dapat di edit lagi'];
        }

        return true;
    }

}
