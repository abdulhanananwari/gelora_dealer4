<?php

namespace Gelora\PolReg\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class RegistrationLeasingBpkbSubmissionBatchController extends Controller {

    protected $registrationBatch;

    public function __construct() {
        parent::__construct();
        $this->registrationBatch = new \Gelora\PolReg\App\RegistrationLeasingBpkbSubmissionBatch\RegistrationLeasingBpkbSubmissionBatchModel;

        $this->transformer = new \Gelora\PolReg\App\RegistrationLeasingBpkbSubmissionBatch\Transformers\RegistrationLeasingBpkbSubmissionBatchTransformer();
    }

    public function index(Request $request) {

        $query = $this->registrationBatch->newQuery();

        if ($request->get('status') == 'closed') {
            $query->whereNotNull('closed_at');
        } else if ($request->get('status') == 'active') {
            $query->whereNull('closed_at');
        }

        if ($request->has('main_leasing_name')) {
            $query->where('mainLeasing.name', $request->get('main_leasing_name'));
        }
        if ($request->has('main_leasing_id')) {
            $query->where('mainLeasing.id', (int) $request->get('main_leasing_id'));
        }
        if ($request->has('sub_leasing_name')) {
            $query->where('subLeasing.name', $request->get('sub_leasing_name'));
        }

        if ($request->has('paginate')) {

            $registrationBatch = $query->paginate((int) $request->get('paginate', 20));
            return $this->formatCollection($registrationBatch, [], $registrationBatch);
        } else {

            $registrationBatch = $query->get();
            return $this->formatCollection($registrationBatch);
        }
    }

    public function show($id) {

        $registrationBatch = $this->registrationBatch->find($id);

        return $this->formatItem($registrationBatch);
    }

    public function store(Request $request) {

        $registrationBatch = $this->registrationBatch;

        $registrationBatch->assign()->fromRequest($request);
        $registrationBatch->action()->onCreate();

        return $this->formatItem($registrationBatch);
    }

    public function update($id, Request $request) {

        $registrationBatch = $this->registrationBatch->find($id);
        $registrationBatch->assign()->fromRequest($request);

        $validation = $registrationBatch->validate()->onUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $registrationBatch->save();

        return $this->formatItem($registrationBatch);
    }

    public function close($id, Request $request) {

        $registrationBatch = $this->registrationBatch->find($id);

        $validation = $registrationBatch->validate()->onClose();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $registrationBatch->action()->onClose();

        return $this->formatItem($registrationBatch);
    }

    public function handover($id, Request $request) {

        $registrationBatch = $this->registrationBatch->find($id);

        $validation = $registrationBatch->validate()->onHandover();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $registrationBatch->action()->onHandover();

        return $this->formatItem($registrationBatch);
    }

}
