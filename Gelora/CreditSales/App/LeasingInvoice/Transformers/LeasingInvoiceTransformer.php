<?php

namespace Gelora\CreditSales\App\LeasingInvoice\Transformers;

use League\Fractal;
use Gelora\CreditSales\App\LeasingInvoice\LeasingInvoiceModel;

class LeasingInvoiceTransformer extends Fractal\TransformerAbstract {

    public $defaultIncludes = ['salesOrders'];
    
    public function transform(LeasingInvoiceModel $leasingInvoice) {

        return [
            'id' => $leasingInvoice->_id,
            '_id' => $leasingInvoice->_id,
            
            'mainLeasing' => $leasingInvoice->mainLeasing,
            'subLeasing' => $leasingInvoice->subLeasing,

            'created_at' => $leasingInvoice->created_at->toDateTimeString(),
            'creator' => $leasingInvoice->creator,
            
            'closed_at' => $leasingInvoice->closed_at ? $leasingInvoice->closed_at->toDateTimeString() : null,
            'closer' => $leasingInvoice->closer,
        ];
    }
    
    public function includeSalesOrders(LeasingInvoiceModel $leasingInvoice) {
        
        $salesOrders = $leasingInvoice->getSalesOrders();
        
        return $this->collection($salesOrders,
                new \Gelora\Sales\App\SalesOrder\Transformers\SalesOrderTransformer());
    }
}
