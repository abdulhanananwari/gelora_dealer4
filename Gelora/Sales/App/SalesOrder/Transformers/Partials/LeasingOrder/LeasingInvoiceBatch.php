<?php

namespace Gelora\Sales\App\SalesOrder\Transformers\Partials\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class LeasingInvoiceBatch {
    
    public static function transform(SalesOrderModel $salesOrderModel) {
        
        $leasingInvoiceBatch = $salesOrderModel->leasingInvoiceBatch;
        
        $transformer = new \Gelora\CreditSales\App\LeasingInvoiceBatch\Transformers\LeasingInvoiceBatchTransformer();
        return $transformer->transform($leasingInvoiceBatch);
    }
}
