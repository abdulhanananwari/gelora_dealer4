<?php

namespace Gelora\CreditSales\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class LeasingInvoiceBatchController extends Controller {

    protected $leasingInvoiceBatch;

    public function __construct() {
        parent::__construct();
        $this->leasingInvoiceBatch = new \Gelora\CreditSales\App\LeasingInvoiceBatch\LeasingInvoiceBatchModel();

        $this->transformer = new \Gelora\CreditSales\App\LeasingInvoiceBatch\Transformers\LeasingInvoiceBatchTransformer();
        $this->dataName = 'leasing_invoice_batches';
    }

    public function index(Request $request) {

        $query = $this->leasingInvoiceBatch->newQuery();

        if ($request->get('status') == 'closed') {
            $query->whereNotNull('closed_at');
        } else if ($request->get('status') == 'active') {
            $query->whereNull('closed_at');
        }

        if ($request->has('main_leasing_id')) {
            $query->where('mainLeasing.id', (int) $request->get('main_leasing_id'));
        }
        if ($request->has('main_leasing_name')) {
            $query->where('mainLeasing.name', 'LIKE', '%' . $request->get('main_leasing_name') . '%');
        }

        if ($request->has('sub_leasing_id')) {
            $query->where('subLeasing.id', (int) $request->get('sub_leasing_id'));
        }

        if ($request->has('sub_leasing_name')) {
            $query->where('subLeasing.name', 'LIKE', '%' . $request->get('sub_leasing_name') . '%');
        }

        $query->orderBy($request->get('order_by', 'created_at'), $request->get('order', 'desc'));

        if ($request->has('paginate')) {

            $leasingInvoiceBatches =  $query->paginate( (int) $request->get('paginate', 20));
            return $this->formatCollection($leasingInvoiceBatches, [], $leasingInvoiceBatches);
        } else {

            $leasingInvoiceBatches = $query->get();
            return $this->formatCollection($leasingInvoiceBatches);
        }
    }

    public function get($id, Request $request) {

        $leasingInvoiceBatch = $this->leasingInvoiceBatch->find($id);

        return $this->formatItem($leasingInvoiceBatch);
    }

    public function store(Request $request) {

        $leasingInvoiceBatch = $this->leasingInvoiceBatch->assign()->fromRequest($request);

        $validation = $leasingInvoiceBatch->validate()->onCreate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $leasingInvoiceBatch->action()->onCreate();

        return $this->formatItem($leasingInvoiceBatch);
    }

    public function update($id, Request $request) {

        $leasingInvoiceBatch = $this->leasingInvoiceBatch->find($id);
        
        $validation = $leasingInvoiceBatch->validate()->onCreate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }
        $leasingInvoiceBatch->assign()->fromRequest($request);

        $leasingInvoiceBatch->save();

        return $this->formatItem($leasingInvoiceBatch);
    }

    public function close($id, Request $request) {

        $leasingInvoiceBatch = $this->leasingInvoiceBatch->find($id);

        $validation = $leasingInvoiceBatch->validate()->onClose();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }
        $leasingInvoiceBatch->action()->onClose();
        return $this->formatItem($leasingInvoiceBatch);
    }

}
