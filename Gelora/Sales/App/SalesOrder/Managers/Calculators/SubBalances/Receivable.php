<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Calculators\SubBalances;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Receivable {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function calculate() {
        
        $receivables = $this->retrieve();
        
        return [
            'receivables' => $receivables,
            'total' => collect($receivables)->sum('amount')
        ];
    }
    
    protected function retrieve() {
        
        return \SolTransaction::due()->index()
                ->filter('type', 'P')
                ->filter('transactable_type', 'SalesOrder')
                ->filter('transactable_id', $this->salesOrder->id)
                ->filter('transactable_app', config('app.name'))
                ->run();
    }
}
