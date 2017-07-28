<?php

namespace Gelora\PolReg\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class MdSubmissionBatchController extends Controller {

    protected $registrationBatch;

    public function __construct() {
        parent::__construct();
        $this->registrationBatch = new \Gelora\PolReg\App\MdSubmissionBatch\MdSubmissionBatchModel();
        $this->transformer = new \Gelora\PolReg\App\MdSubmissionBatch\Transformers\MdSubmissionBatchTransformer();
    }

    public function index(Request $request) {

        $query = $this->registrationBatch->newQuery();

        if ($request->get('status') == 'closed') {
            $query->whereNotNull('closed_at');
        } else if ($request->get('status') == 'active') {
            $query->whereNull('closed_at');
        }
        
        $query->orderBy($request->get('order_by', 'created_at'), $request->get('order', 'desc'));
        
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

    public function sendEmail($id, Request $request) {

        $registrationBatch = $this->registrationBatch->find($id);

        $registrationBatch->action()->onSendEmail($request->get('email'));

        return $this->formatItem($registrationBatch);
    }

}
