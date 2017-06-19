<?php

namespace Gelora\PolReg\Http\Controllers\Api\Registration;

use Gelora\PolReg\Http\Controllers\Api\RegistrationController;
use Illuminate\Http\Request;

class CancelController extends RegistrationController {

    protected $registration;

    public function __construct() {
        parent::__construct();
    }

    public function mdSubmissionBatch($id, Request $request) {
        $registration = $this->registration->find($id);

        $validation = $registration->validate()->onBatchCancel()->mdSubmissionBatch();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }
        $registration->action()->onCancel()->mdSubmissionBatch();
        return $this->formatItem($registration);
    }

    public function agencySubmissionBatch($id, Request $request) {
        $registration = $this->registration->find($id);

        $validation = $registration->validate()->onBatchCancel()->agencySubmissionBatch();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }
        $registration->action()->onCancel()->agencySubmissionBatch();
        return $this->formatItem($registration);
    }

    public function agencyInvoice($id, Request $request) {
        $registration = $this->registration->find($id);

        $validation = $registration->validate()->onBatchCancel()->agencyInvoice();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }
        $registration->action()->onCancel()->agencyInvoice();
        return $this->formatItem($registration);
    }

    public function leasingBpkbSubmissionBatch($id, Request $request) {
        $registration = $this->registration->find($id);

        $validation = $registration->validate()->onBatchCancel()->leasingBpkbSubmissionBatch();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $registration->action()->onCancel()->leasingBpkbSubmissionBatch();
        return $this->formatItem($registration);
    }

    public function pendingMdSubmissionBatch($id, Request $request) {

        $registration = $this->registration->find($id);

        $validation = $registration->validate()->onUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $registration->action()->onCancel()->pendingMdSubmissionBatch();
        return $this->formatItem($registration);
    }
    public function pendingAgencySubmissionBatch($id, Request $request) {

        $registration = $this->registration->find($id);

        $validation = $registration->validate()->onUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $registration->action()->onCancel()->pendingAgencySubmissionBatch();
        return $this->formatItem($registration);
    }
    public function pendingLeasingBpkbSubmissionBatch($id, Request $request) {

        $registration = $this->registration->find($id);

        $validation = $registration->validate()->onUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $registration->action()->onCancel()->pendingLeasingBpkbSubmissionBatch();
        return $this->formatItem($registration);
    }

}
