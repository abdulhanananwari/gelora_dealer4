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
        $this->dataName = 'leasing_invoices';
    }

    public function index(Request $request) {

        $query = $this->leasingInvoice->newQuery();

        if ($request->has('main_leasing_id')) {
            $query->where('mainLeasing.id', (int) $request->get('main_leasing_id'));
        }
        if ($request->has('main_leasing_name')) {
            $query->where('mainLeasing.name', 'LIKE', '%' . $request->get('main_leasing_name') . '%');
        }

        if ($request->has('sub_leasing_id')) {
            $query->where('subLeasing.id', $request->get('sub_leasing_id'));
        }

        if ($request->has('sub_leasing_name')) {
            $query->where('subLeasing.name', 'LIKE', '%' . $request->get('sub_leasing_name') . '%');
        }

        $query->orderBy($request->get('order_by', 'created_at'), $request->get('order', 'desc'));

        if ($request->has('paginate')) {

            $leasingInvoices = $query->paginate($request->get('paginate', 20));
            return $this->formatCollection($leasingInvoices, [], $leasingInvoices);
        } else {

            $leasingInvoices = $query->get();
            return $this->formatCollection($leasingInvoices);
        }
    }

    public function get($id, Request $request) {

        $leasingInvoice = $this->leasingOrder->find($id);

        return $this->formatItem($leasingOrder);
    }

    public function store(Request $request) {

        $leasingOrder = $this->leasingOrder->assign()->fromRequest($request);
        $leasingOrder->calculate()->balances();

        $validation = $leasingOrder->validate()->onCreateOrUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $leasingOrder->action()->onCreateAndUpdate();

        return $this->formatItem($leasingOrder);
    }

    public function update($id, Request $request) {

        $leasingOrder = $this->leasingOrder->find($id);
        $leasingOrder->assign()->fromRequest($request);
        $leasingOrder->calculate()->balances();

        $validation = $leasingOrder->validate()->onCreateOrUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $leasingOrder->action()->onCreateAndUpdate();

        return $this->formatItem($leasingOrder);
    }

}
