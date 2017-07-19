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
                if ($this->salesOrder->getAttribute('polReg.agency_submission_batch_id')) {
                    return ['Tidak bisa menghapus batch karena sudah diserahkan ke biro jasa'];
                }
                break;
            case 'agency_submission_batch_id':
                $agencySubmissionBatch = $this->salesOrder->getAgencySubmissionBatch();
                if ($agencySubmissionBatch->closed_at) {
                    return ['Tidak bisa menghapus batch karena sudah ditutup '];
                }
                break;
            case 'agency_invoice_id':
                $agencyInvoice = $this->salesOrder->getAgencyInvoice();
                if ($agencyInvoice->closed_at) {
                    return ['Tidak bisa menghapus batch karena sudah ditutup'];
                }
                break;
            case 'leasing_submission_batch_id':
                $leasingSubmissionBatch = $this->salesOrder->getLeasingBpkbSubmissionBatch();
                if ($leasingSubmissionBatch->closed_at) {
                    return ['Tidak bisa menghapus batch karena  sudah ditutup'];
                }
                break;
            default;
                break;
        }

        return true;
    }

}
