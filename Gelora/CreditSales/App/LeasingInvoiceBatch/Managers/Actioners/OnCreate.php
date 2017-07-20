<?php

namespace Gelora\CreditSales\App\LeasingInvoiceBatch\Managers\Actioners;

use Gelora\CreditSales\App\LeasingInvoiceBatch\LeasingInvoiceBatchModel;

<<<<<<< HEAD
=======

>>>>>>> 57aadacd85e4767cf7d030c496a2b0198dd23479
class OnCreate {
    
    protected $leasingInvoiceBatch;

    public function __construct(LeasingInvoiceBatchModel $leasingInvoiceBatch) {
        $this->leasingInvoiceBatch = $leasingInvoiceBatch;
    }

    public function action() {

        $this->leasingInvoiceBatch->assignCreator();

        $this->leasingInvoiceBatch->save();

        return $this->leasingInvoiceBatch;
    }

}
