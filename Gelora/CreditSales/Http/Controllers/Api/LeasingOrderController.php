<?php

namespace Gelora\CreditSales\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class LeasingOrderController extends Controller {

    protected $leasingOrder;

    public function __construct() {
        parent::__construct();
        $this->leasingOrder = new \Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel();

        $this->transformer = new \Gelora\CreditSales\App\LeasingOrder\Transformers\LeasingOrderTransformer();
        $this->dataName = 'leasing_orders';
    }

    public function index(Request $request) {

        $query = $this->leasingOrder->newQuery();

        if ($request->get('leasing_personnel_access') == 'true') {

            $leasingPersonnel = \Gelora\CreditSales\App\LeasingPersonnel\LeasingPersonnelModel::
                    where('user.id', \ParsedJwt::getByKey('sub'))->first();

            $query->where('mainLeasing.id', $leasingPersonnel['leasing']['mainLeasing']['id']);
        }

        if ($request->has('sales_order_id')) {
            if ($request->get('sales_order_id') == 'null') {
                $query->whereNull('sales_order_id');
            } else {
                $query->where('sales_order_id', $request->get('sales_order_id'));
            }
        }

        if ($request->has('po_number')) {
            $query->where('po_number', $request->get('po_number'));
        }

        if ($request->has('customer_name')) {
            $query->where('customer.name', 'LIKE', '%' . $request->get('customer_name') . '%');
        }

        if ($request->has('registration_name')) {
            $query->where('registration.name', 'LIKE', '%' . $request->get('registration_name') . '%');
        }

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

            $leasingOrders = $query->paginate($request->get('paginate', 20));
            return $this->formatCollection($leasingOrders, [], $leasingOrders);
        } else {

            $leasingOrders = $query->get();
            return $this->formatCollection($leasingOrders);
        }
    }

    public function get($id, Request $request) {

        $leasingOrder = $this->leasingOrder->find($id);

        return $this->formatItem($leasingOrder);
    }

    public function store(Request $request) {

        $leasingOrder = $this->leasingOrder->assign()->fromRequest($request);
        $leasingOrder->calculate()->balances();

        $validation = $leasingOrder->validate()->onCreateOrUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $leasingOrder->action()->onCreateOrUpdate();

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

        $leasingOrder->action()->onCreateOrUpdate();

        return $this->formatItem($leasingOrder);
    }

}
