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
        if ($request->has('type_name')) {
            $query->where('unit.type_name', $request->get('type_name'));
        }
        if ($request->has('color_name')) {
            $query->where('unit.color_name', $request->get('color_name'));
        }

        if ($request->has('driver_id')) {
            $query->where('delivery.driver.user_id', (int) $request->get('driver_id'));
        } else if ($request->has('driver_name')) {
            $query->where('delivery.driver.name', 'LIKE', '%' . $request->get('driver_name') . '%');
        }

        if ($request->has('unit_id')) {
            $query->where('unit_id', new ObjectID($request->get('unit_id')));
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

        if ($request->has('status')) {
            switch ($request->get('status')) {
                case 'unvalidated':
                    $query->whereNull('validated_at');
                    break;
                case 'unvalidated_and_indent':
                    $query->whereNull('validated_at')->whereNotNull('indent');
                    break;
                case 'validated':
                    $query->whereNotNull('validated_at');
                    break;
                case 'delivery_generated':
                    $query->whereNotNull('delivery.generated_at');
                    break;
                case 'delivery_handover_created':
                    $query->whereNotNull('delivery.handover.created_at');
                    break;
                case 'financial_closed':
                    $query->whereNotNull('financial_closed_at');
                    break;
                case 'financial_unclosed':
                    $query->whereNull('financial_closed_at');
                    break;
                default;
                    break;
            }
        }

        $query->orderBy($request->get('order_by', 'created_at'), $request->get('order', 'desc'));

        return $query;
    }

}
