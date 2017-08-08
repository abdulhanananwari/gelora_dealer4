<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Calculators\SubBalances;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Transaction {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function calculate() {
        
        $transactions = $this->retrieve();
        
        return [
            'transactions' => $transactions,
            'total' => collect($transactions)->sum('amount')
        ];
    }
    
    protected function retrieve() {
        
        return \SolTransaction::transaction()->index()
                ->filter('transactable_type', 'SalesOrder')
                ->filter('transactable_subtype', 'CustomerPayment')
                ->filter('transactable_id', $this->salesOrder->id)
                ->filter('transactable_app', config('app.name'))
                ->run();
    }
}
