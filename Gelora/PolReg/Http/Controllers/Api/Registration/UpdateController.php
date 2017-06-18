<?php

namespace Gelora\PolReg\Http\Controllers\Api\Registration;

use Gelora\PolReg\Http\Controllers\Api\RegistrationController;
use Illuminate\Http\Request;

class UpdateController extends RegistrationController {

    protected $registration;

    public function __construct() {
        parent::__construct();
    }

    public function mdSubmissionBatch($id, Request $request) {

        $registration = $this->registration->find($id);
        $registration->registration_md_submission_batch_id = $request->get('registration_md_submission_batch_id');

        $validation = $registration->validate()->onBatchUpdate()->mdSubmissionBatch();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $registration->action()->onUpdate();

        return $this->formatItem($registration);
    }

    public function confirmMdSubmissionBatch($id, Request $request) {

        $registration = $this->registration->find($id);

        $validation = $registration->validate()->onConfirmMdSubmissionBatch();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $registration->action()->onConfirm((bool) $request->get('confirmed_success'));

        return $this->formatItem($registration);
    }

    public function agencySubmissionBatch($id, Request $request) {

        $registration = $this->registration->find($id);
        $registration->registration_agency_submission_batch_id = $request->get('registration_agency_submission_batch_id');

        $validation = $registration->validate()->onBatchUpdate()->agencySubmissionBatch();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $registration->action()->onUpdate();

        return $this->formatItem($registration);
    }

    public function agencyInvoice($id, Request $request) {

        $registration = $this->registration->find($id);
        $registration->registration_agency_invoice_id = $request->get('registration_agency_invoice_id');

        $validation = $registration->validate()->onBatchUpdate()->agencyInvoice();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $registration->action()->onUpdate();

        return $this->formatItem($registration);
    }

    public function leasingBpkbSubmissionBatch($id, Request $request) {

        $registration = $this->registration->find($id);
        $registration->registration_leasing_bpkb_submission_batch_id = $request->get('registration_leasing_bpkb_submission_batch_id');

        $validation = $registration->validate()->onBatchUpdate()->leasingBpkbSubmissionBatch();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $registration->action()->onUpdate();

        return $this->formatItem($registration);
    }

    public function amounts($id, Request $request) {

        $registration = $this->registration->find($id);
        $registration->assign()->fromArrayOnlyIfSet($request->only('amounts'));

        $validation = $registration->validate()->onUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $registration->action()->onUpdate();

        return $this->formatItem($registration);
    }

    public function itemIncoming($id, Request $request) {

        $registration = $this->registration->find($id);

        $validation = $registration->validate()->onItemHandover('INCOMING', $request->get('name'));
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }


        $registration->assign()->item()->incoming($request->get('name'), $request->get('incoming'));
        $registration->save();

        return $this->formatItem($registration);
    }

    public function itemOutgoing($id, Request $request) {

        $registration = $this->registration->find($id);

        $validation = $registration->validate()->onItemHandover('OUTGOING', $request->get('name'));
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $registration->assign()->item()->outgoing($request->get('name'), $request->get('outgoing'));
        $registration->save();

        return $this->formatItem($registration);
    }

    public function cost($id, Request $request) {

        $registration = $this->registration->find($id);

        $cost = $registration->assign()->cost($request->get('cost'));

        $validation = $registration->validate()->onCostUpdate($cost);
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $registration->action()->onCostUpdate($cost);

        return $this->formatItem($registration);
    }

}
