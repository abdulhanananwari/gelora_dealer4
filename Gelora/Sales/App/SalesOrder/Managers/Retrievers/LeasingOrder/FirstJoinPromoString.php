<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Retrievers\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;
use Solumax\PhpHelper\App\Mongo\SubDocument;

class FirstJoinPromoString {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function retrieve() {
        
        if (is_array($this->salesOrder->getAttribute('leasingOrder.joinPromos'))) {

            $joinPromoSubDoc = new SubDocument($this->salesOrder->getAttribute('leasingOrder.joinPromos')[0]);
            $paymentDate = $joinPromoSubDoc->get('transaction.created_at') ? $joinPromoSubDoc->toCarbon('transaction.created_at')->toDateString() : '';
            $joinPromoString = $joinPromoSubDoc->get('transfer_amount') . '(' . $paymentDate . ')';
            return $joinPromoString;  
        }

    
    }
}
