<?php

namespace Gelora\CreditSales\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class LeasingInvoiceController extends Controller {

    protected $leasingInvoice;

    public function __construct() {
        parent::__construct();
        $this->leasingInvoice = new \Gelora\CreditSales\App\LeasingInvoice\LeasingInvoiceModel();

        $this->transformer = new \Gelora\CreditSales\App\LeasingInvoice\Transformers\LeasingInvoiceTransformer();
    }

    public function index(Request $request) {

        $query = $this->leasingInvoice->newQuery();

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


        if ($request->has('paginate')) {

            $leasingInvoices = $query->paginate((int) $request->get('paginate', 20));
            return $this->formatCollection($leasingInvoices, [], $leasingInvoices);
        } else {

            $leasingInvoices = $query->get();
            return $this->formatCollection($leasingInvoices);
        }
    }

    public function get($id) {

        $leasingInvoice = $this->leasingInvoice->find($id);

        return $this->formatItem($leasingInvoice);
    }

    public function store(Request $request) {

        $leasingInvoice = $this->leasingInvoice;

        $leasingInvoice->assign()->fromRequest($request);
        $leasingInvoice->action()->onCreate();

        return $this->formatItem($leasingInvoice);
    }

    public function update($id, Request $request) {

        $leasingInvoice = $this->leasingInvoice->find($id);

        $leasingInvoice->assign()->fromRequest($request);

        $validation = $leasingInvoice->validate()->onUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $leasingInvoice->save();

        return $this->formatItem($leasingInvoice);
    }

    public function close($id, Request $request) {

        $leasingInvoice = $this->leasingInvoice->find($id);

        $validation = $leasingInvoice->validate()->onClose();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $leasingInvoice->action()->onClose();

        return $this->formatItem($leasingInvoice);
    }

}
