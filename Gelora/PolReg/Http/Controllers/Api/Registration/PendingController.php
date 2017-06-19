<?php

namespace Gelora\PolReg\Http\Controllers\Api\Registration;

use Gelora\PolReg\Http\Controllers\Api\RegistrationController;
use Illuminate\Http\Request;

class PendingController extends RegistrationController {

    protected $registration;

    public function __construct() {
        parent::__construct();
    }

    public function mdSubmissionBatch($id, Request $request) {

        $registration = $this->registration->find($id);
        $registration->assign()->pending()->mdSubmissionBatch($request);

        $validation = $registration->validate()->onBatchPending()->mdSubmissionBatch();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $registration->action()->onUpdate();
        return $this->formatItem($registration);
    }

    public function agencySubmissionBatch($id, Request $request) {

        $registration = $this->registration->find($id);
        $registration->assign()->pending()->agencySubmissionBatch($request);

        $validation = $registration->validate()->onBatchPending()->agencySubmissionBatch();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $registration->action()->onUpdate();
        return $this->formatItem($registration);
    }

    public function leasingBpkbSubmissionBatch($id, Request $request) {

        $registration = $this->registration->find($id);
        $registration->assign()->pending()->leasingBpkbSubmissionBatch($request);

        $validation = $registration->validate()->onBatchPending()->leasingBpkbSubmissionBatch();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $registration->action()->onUpdate();
        return $this->formatItem($registration);
    }

}
