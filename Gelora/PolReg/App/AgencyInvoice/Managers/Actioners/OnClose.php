<?php

namespace Gelora\PolReg\App\AgencyInvoice\Managers\Actioners;

use Gelora\PolReg\App\AgencyInvoice\AgencyInvoiceModel;

class OnClose {

    protected $registrationBatch;

    public function __construct(AgencyInvoiceModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function action() {

        $this->registrationBatch->closed_at = \Carbon\Carbon::now();
        $this->registrationBatch->assignEntityData('closer');

        $this->registrationBatch->save();
        return $this->registrationBatch;
    }

}
