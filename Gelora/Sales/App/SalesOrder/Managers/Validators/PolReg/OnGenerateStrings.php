<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\PolReg;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnGenerateStrings {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {

        if (empty($this->salesOrder->getAttribute('cddb'))) {
            return ['String CDDB belum dibuat'];
        }

        $mdSubmissionBatch = $this->salesOrder->getMdSubmissionBatch();
        if ($mdSubmissionBatch && $mdSubmissionBatch->getAttribute('closed_at') != null) {
            return ['Batch untuk MD sudah ditutup'];
        }


        return true;
    }

}
