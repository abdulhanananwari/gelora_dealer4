<?php

namespace Gelora\PolReg\App\AgencyInvoice\Managers\Calculators;

use Gelora\PolReg\App\AgencyInvoice\AgencyInvoiceModel;

class Balances {

    protected $registrationBatch;

    public function __construct(AgencyInvoiceModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
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
    			->filter('transactable_type', 'AgencyInvoice')
    			->filter('transactable_id', $this->registrationBatch->id)
    			->filter('transactable_app', config('app.name'))
    			->run();
    }

}
