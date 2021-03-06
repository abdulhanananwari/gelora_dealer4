<?php

namespace Gelora\Sales\App\SalesOrder\Managers;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;
use MongoDB\BSON\ObjectID;

class QueryBuilder {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    protected function parseDate($dateString) {
        return \Carbon\Carbon::createFromFormat('Y-m-d', $dateString);
    }

    public function build($query, \Illuminate\Http\Request $request) {

        if ($request->has('sales_personnel_access')) {
            if ($request->get('sales_personnel_access')['team']) {
                $query->where('salesPersonnel.team_id', $request->get('sales_personnel_access')['team']['id']);
            } else if ($request->get('sales_personnel_access')['personnel']) {
                $query->where('salesPersonnel.id', $request->get('sales_personnel_access')['personnel']['id']);
            }
        }

        if ($request->has('from')) {
            $from = $this->parseDate($request->get('from'))->startOfDay();
            $query->where($request->get('time_type', 'created_at'), '>=', $from);
        }

        if ($request->has('until')) {
            $until = $this->parseDate($request->get('until'))->endOfDay();
            $query->where($request->get('time_type', 'created_at'), '<=', $until);
        }

        if ($request->has('customer_name')) {
            $query->where('customer.name', 'LIKE', '%' . $request->get('customer_name') . '%');
        }

        if ($request->has('customer_phone_number')) {
            $query->where('customer.phone_number', 'LIKE', '%' . $request->get('customer_phone_number') . '%');
        }
        if ($request->has('registration_name')) {
            $query->where('registration.name', 'LIKE', '%' . $request->get('registration_name') . '%');
        }
        if ($request->has('sales_personnel_entity_id')) {
            $query->where('salesPersonnel.entity.id', (int) $request->get('sales_personnel_entity_id'));
        }
        if ($request->has('sales_personnel_team_id')) {
            $query->where('salesPersonnel.team.id', $request->get('sales_personnel_team_id'));
        }
        if ($request->has('customer_type')) {
            $query->where('customer.type', $request->get('customer_type'));
        }
        if ($request->has('payment_type')) {
            $query->where('payment_type', $request->get('payment_type'));
        }
        if ($request->has('main_leasing_id')) {
            $query->where('leasingOrder.mainLeasing.id', (int) $request->get('main_leasing_id'));
        }
        if ($request->has('sub_leasing_id')) {
            $query->where('leasingOrder.subLeasing.id', (int) $request->get('sub_leasing_id'));
        }
        if ($request->has('driver_id')) {
            $query->where('delivery.driver.id', (int) $request->get('driver_id'));
        } else if ($request->has('driver_name')) {
            $query->where('delivery.driver.name', 'LIKE', '%' . $request->get('driver_name') . '%');
        }

        if ($request->has('unit_id')) {
            $query->where('unit_id', new ObjectID($request->get('unit_id')));
        }

        if ($request->has('mediator_fee')) {
            $query->where('mediator_fee', $request->get('mediator_fee_type', '='), (int) $request->get('mediator_fee'));
        }

        if ($request->has('vehicle_model_ids')) {

            $modelIds = [];
            foreach (explode(',', $request->get('vehicle_model_ids')) as $modelId) {
                $modelIds[] = (int) $modelId;
            }
            
            $query->whereIn('vehicle.id', $modelIds);
        }

        if ($request->has('registration_item_incoming')) {
            foreach (json_decode($request->get('registration_item_incoming'), true) as $key => $value) {
                if ($value == 'completed') {
                    $query->whereNotNull('polReg.items.' . $key . '.incoming');
                } else {
                    $query->whereNull('polReg.items.' . $key . '.incoming');
                }
            }
        }

        if ($request->has('registration_item_outgoing')) {
            foreach (json_decode($request->get('registration_item_outgoing'), true) as $key => $value) {
                if ($value == 'completed') {
                    $query->whereNotNull('polReg.items.' . $key . '.outgoing');
                } else {
                    $query->whereNull('polReg.items.' . $key . '.outgoing');
                }
            }
        }

        if ($request->get('customer_invoice_pending') == 'true') {
            $query->whereNotNull('customerInvoice');

            if ($request->has('customer_invoice_delegate_name')) {
                $query->where('customerInvoice.delegate.name', $request->get('customer_invoice_delegate_name'));
            }

            if ($request->has('customer_invoice_created_at')) {
                $query->whereBetween('customerInvoice.created_at', [
                    $this->parseDate($request->get('customer_invoice_created_at'))->startOfDay(),
                    $this->parseDate($request->get('customer_invoice_created_at'))->endOfDay(),
                ]);
            }
        }

        $this->queryCustomerArea($query, $request);
        $this->queryStatuses($query, $request);

        $query->orderBy($request->get('order_by', 'created_at'), $request->get('order', 'desc'));
        if ($request->has('order_by')) {
            $query->whereNotNull($request->get('order_by'));
        }

        return $query;
    }

    protected function queryCustomerArea($query, \Illuminate\Http\Request $request) {

        if ($request->has('customer_area')) {
            $params = explode(',', $request->get('customer_area'));
            foreach ($params as $param) {
                $paramArray = explode(':', $param);
                $query->where('customer.' . $paramArray[0], $paramArray[1]);
            }
        }

        return $query;
    }

    protected function queryStatuses($query, \Illuminate\Http\Request $request) {

        if ($request->has('statuses')) {
            
            if (is_string($request->get('statuses'))) {
                $statuses = json_decode($request->get('statuses'), true);
            } else {
                $statuses = $request->get('statuses');
            }

            foreach ($statuses as $key => $value) {
                $key = str_replace('->', '.', $key);

                if ($value == 'no') {
                    $query->whereNull($key);
                } else if ($value == 'yes') {
                    $query->whereNotNull($key);
                }
            }
        }

        return $query;
    }

    protected function queryStatus($query, \Illuminate\Http\Request $request) {

        if ($request->has('status')) {
            switch ($request->get('status')) {
                case 'unvalidated':
                    $query->whereNull('validated_at');
                    break;
                case 'unvalidated':
                    $query->whereNull('validated_at');
                    break;
                case 'indent':
                    $query->whereNotNull('indent.created_at')->whereNull('delivery.generated_at');
                    break;
                case 'validated':
                    $query->whereNotNull('validated_at')->whereNull('delivery.generated_at');
                    break;
                case 'delivery_generated':
                    $query->whereNotNull('delivery.generated_at')->whereNull('delivery.handover.created_at');
                    break;
                case 'delivery_handover_created':
                    $query->whereNotNull('delivery.handover.created_at')->whereNull('delivery.handoverConfirmation.created_at');
                    break;
                case 'delivery_handover_confirmation_created':
                    $query->whereNotNull('delivery.handoverConfirmation.created_at');
                    break;
                case 'financial_closed':
                    $query->whereNotNull('financial_closed_at');
                    break;
                case 'financial_unclosed':
                    $query->whereNull('financial_closed_at');
                    break;
                case 'delivery_generated_and_not_invoiced':
                    $query->whereNotNull('delivery.generated_at')->whereNull('leasingOrder.invoice_generated_at');
                    break;
                case 'invoice_generated_and_not_batched':
                    $query->whereNotNull('leasingOrder.invoice_generated_at')->whereNull('leasingOrder.leasing_invoice_batch_id');
                    break;
                case 'invoice_batched_and_not_paid':
                    $query->whereNotNull('leasingOrder.leasing_invoice_batch_id')->whereNull('leasingOrder.payment_at');
                    break;
                case 'main_receivable_paid':
                    $query->whereNotNull('leasingOrder.payment_at');
                    break;
                default;
                    break;
            }
        }

        return $query;
    }

}

//
//            if (in_array('validated', $statuses)) {
//                $query->whereNotNull('validated_at');
//            }
//
//            if (in_array('unvalidated', $statuses)) {
//                $query->whereNull('validated_at');
//            }
//            
//            if (in_array('unvalidated_and_indent', $statuses)) {
//                $query->whereNull('validated_at')->whereNotNull('indent.created_at')->whereNull('delivery.generated_at');
//            }
//            if (in_array('leasing_order_invoice_batched', $statuses)) {
//                $query->whereNotNull('leasingOrder.leasing_invoice_batch_id');
//            }
//            if (in_array('delivery_generated', $statuses)) {
//                $query->whereNotNull('delivery.generated_at')->whereNull('delivery.handover.created_at');
//            }
//            if (in_array('delivery_handover_created', $statuses)) {
//                $query->whereNotNull('delivery.handover.created_at')->whereNull('delivery.handoverConfirmation.created_at');
//            }
//            if (in_array('delivery_handover_confirmed', $statuses)) {
//                $query->whereNotNull('delivery.handoverConfirmation.created_at');
//            }
//            if (in_array('financial_closed', $statuses)) {
//                $query->whereNotNull('financial_closed_at');
//            }
//            if (in_array('financial_unclosed', $statuses)) {
//                $query->whereNull('financial_closed_at');
//            }
//            if (in_array('delivery_generated_and_not_invoiced', $statuses)) {
//                $query->whereNotNull('delivery.generated_at')->whereNull('leasingOrder.invoice_generated_at');
//            }
//            if (in_array('invoice_generated_and_not_batched', $statuses)) {
//                $query->whereNotNull('leasingOrder.invoice_generated_at')->whereNull('leasingOrder.leasing_invoice_batch_id');
//            }
//            if (in_array('invoice_batched_and_not_paid', $statuses)) {
//                $query->whereNotNull('leasingOrder.leasing_invoice_batch_id')->whereNull('leasingOrder.payment_at');
//            }
//            if (in_array('main_receivable_paid', $statuses)) {
//                $query->whereNotNull('leasingOrder.payment_at');
//            }
//            if (in_array('polreg_cddb_string_generated', $statuses)) {
//                $query->whereNotNull('polReg.strings.created_at');
//            }
//            if (in_array('polreg_md_submission_batched', $statuses)) {
//                $query->whereNotNull('polReg.md_submission_batch_id');
//            }