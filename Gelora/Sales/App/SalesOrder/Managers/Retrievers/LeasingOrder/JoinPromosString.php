<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Retrievers\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;
use Solumax\PhpHelper\App\Mongo\SubDocument;

class JoinPromosString {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function retrieve() {
        
        $joinPromoString = '';

        if (is_array($this->salesOrder->getAttribute('leasingOrder.joinPromos'))) {

            foreach ($this->salesOrder->getAttribute('leasingOrder.joinPromos') as $joinPromo) {

                $joinPromoSubDoc = new SubDocument($joinPromo);

                $paymentDate = $joinPromoSubDoc->get('transaction.created_at') ? $joinPromoSubDoc->toCarbon('transaction.created_at')->toDateString() : 'UNPAID';

                $joinPromoString = $joinPromoString .
                    $joinPromoSubDoc->amount . '|' . 
                    $joinPromoSubDoc->transfer_amount .
                    '(' . $paymentDate . ')' . ';';         
            }
        }

        return $joinPromoString;  
    
    }
}
