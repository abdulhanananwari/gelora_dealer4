<?php

namespace Gelora\PolReg\Http\Controllers\Views;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class RegistrationLeasingBpkbSubmissionBatchController extends Controller {

    protected $registrationBatch;

    public function __construct() {
        parent::__construct();
        $this->registrationBatch = new \Gelora\PolReg\App\RegistrationLeasingBpkbSubmissionBatch\RegistrationLeasingBpkbSubmissionBatchModel;

        $this->transformer = new \Gelora\PolReg\App\RegistrationLeasingBpkbSubmissionBatch\Transformers\RegistrationLeasingBpkbSubmissionBatchTransformer();
    }

    public function generateLeasingBpkbReceipt($id) {

        $registrationBatch = $this->registrationBatch->find($id);

        $tenantInfo = (object) \Setting::where('object_type', 'TENANT_INFO')
                        ->first()->data_1;
        $viewData = [
            'registrationBatch' => $registrationBatch,
            'tenantInfo' => $tenantInfo,
        ];

        return view()->make('gelora.polReg::registrationBatches.leasingBpkbSubmissionBatch.leasingBpkbReceipt')
                        ->with('viewData', $viewData);
    }

}
