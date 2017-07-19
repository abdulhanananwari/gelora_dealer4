<?php

namespace Gelora\CreditSales\App\LeasingInvoiceBatch\Transformers;

use League\Fractal;
use Gelora\CreditSales\App\LeasingInvoiceBatch\LeasingInvoiceBatchModel;

class LeasingInvoiceBatchTransformer extends Fractal\TransformerAbstract {

    public $defaultIncludes = ['salesOrders'];
    
    public function transform(LeasingInvoiceBatchModel $leasingInvoiceBatch) {

        return [
            'id' => $leasingInvoiceBatch->_id,
            '_id' => $leasingInvoiceBatch->_id,
            
            'mainLeasing' => $leasingInvoiceBatch->mainLeasing,
            'subLeasing' => $leasingInvoiceBatch->subLeasing,

            'created_at' => $leasingInvoiceBatch->created_at->toDateTimeString(),
            'creator' => $leasingInvoiceBatch->creator,
            'sent_at' => $leasingInvoiceBatch->sent_at ? $leasingInvoiceBatch->sent_at->toDateTimeString() : null,
            
            'closed_at' => $leasingInvoiceBatch->closed_at ? $leasingInvoiceBatch->closed_at->toDateTimeString() : null,
            'closer' => $leasingInvoiceBatch->closer,
        ];
    }
    
    public function includeSalesOrders(LeasingInvoiceBatchModel $leasingInvoiceBatch) {
        
        $salesOrders = $leasingInvoiceBatch->getSalesOrders();
        
        return $this->collection($salesOrders,
                new \Gelora\Sales\App\SalesOrder\Transformers\SalesOrderTransformer());
    }
}
