<?php

namespace Gelora\PolReg\Http\Controllers\Views;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class RegistrationAgencySubmissionBatchController extends Controller {

    protected $registrationBatch;

    public function __construct() {
        parent::__construct();
        $this->registrationBatch = new \Gelora\PolReg\App\RegistrationAgencySubmissionBatch\RegistrationAgencySubmissionBatchModel;

        $this->transformer = new \Gelora\PolReg\App\RegistrationAgencySubmissionBatch\Transformers\RegistrationAgencySubmissionBatchTransformer();
    }

    public function generateAgencyReceipt($id) {

        $registrationBatch = $this->registrationBatch->find($id);

        $tenantInfo = (object) \Setting::where('object_type', 'TENANT_INFO')
                        ->first()->data_1;
        $viewData = [
            'registrationBatch' => $registrationBatch,
            'tenantInfo' => $tenantInfo,
        ];

        return view()->make('gelora.polReg::registrationBatches.agencySubmissionBatch.agencyReceipt')
                        ->with('viewData', $viewData);
    }

}
