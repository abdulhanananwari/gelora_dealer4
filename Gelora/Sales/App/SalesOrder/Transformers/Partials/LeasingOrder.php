<?php

namespace Gelora\Sales\App\SalesOrder\Transformers\Partials;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class LeasingOrder {

    public static function transform(SalesOrderModel $salesOrder) {

        $leasingOrder = $salesOrder->subDocument()->leasingOrder();

        $transformed = [
            'application_number' => $leasingOrder->application_number,
            'po_number' => $leasingOrder->po_number,
            'mainLeasing' => (object) $leasingOrder->mainLeasing,
            'subLeasing' => (object) $leasingOrder->subLeasing,
            'customer' => (object) $leasingOrder->customer,
            'registration' => (object) $leasingOrder->registration,
            'vehicle' => (object) $leasingOrder->vehicle,
            'on_the_road' => (int) $leasingOrder->on_the_road,
            'leasing_payable' => (int) $leasingOrder->on_the_road - $leasingOrder->dp_po,
            'dp_po' => (int) $leasingOrder->dp_po,
            'dp_bayar' => (int) $leasingOrder->dp_bayar,
            'tenor' => (int) $leasingOrder->tenor,
            'cicilan' => (int) $leasingOrder->cicilan,
            'note' => $leasingOrder->note,
            'po_file_uuid' => $leasingOrder->po_file_uuid,
            'memo_file_uuid' => $leasingOrder->memo_file_uuid,
            'po_completer' => $leasingOrder->po_completer,
            'due_uuid' => $leasingOrder->due_uuid,
            'leasing_invoice_batch_id' => $leasingOrder->leasing_invoice_batch_id,
            'payment_transaction_uuid' => $leasingOrder->payment_transaction_uuid,
            'payment_at' => $leasingOrder->toCarbon('payment_at') instanceof \Carbon\Carbon ? $leasingOrder->toCarbon('payment_at')->toDateTimeString() : null,
            'payment_creator' => $leasingOrder->payment_creator,
        ];

        if ($leasingOrder->leasing_invoice_batch_id) {
            $transformed['leasingInvoiceBatch'] = LeasingOrder\LeasingInvoiceBatch::transform($salesOrder);
        }

        if ($leasingOrder->invoice_generated_at) {
            $transformed['invoice_generated_at'] = $salesOrder->getAttribute('leasingOrder.invoice_generated_at') ? $salesOrder->getAttribute('leasingOrder.invoice_generated_at')->toDateTimeString() : null;
            $transformed['invoice_generator'] = (object) $leasingOrder->invoice_generator;
        }

        if (\SolAuthClient::hasAccess('VIEW_LEASING_ORDER_JOIN_PROMOS')) {

            $joinPromos = [];
            foreach ((array)$salesOrder->getAttribute('leasingOrder.joinPromos') as $joinPromo) {
                $joinPromos[] = LeasingOrder\JoinPromo::transform(new \Solumax\PhpHelper\App\Mongo\SubDocument($joinPromo));
            }

            $transformed['joinPromos'] = $joinPromos;
        }

        return $transformed;
    }

}
