<?php

namespace Gelora\PolReg\App\LeasingBpkbSubmissionBatch\Managers\Actioners;

use Gelora\PolReg\App\LeasingBpkbSubmissionBatch\LeasingBpkbSubmissionBatchModel;
use Solumax\PhpHelper\App\Mongo\SubDocument;

class OnClose {

    protected $registrationBatch;

    public function __construct(LeasingBpkbSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function action() {
        
        $salesOrders = $this->registrationBatch->getSalesOrders();

        foreach ($salesOrders as $salesOrder) {
           
            $this->assignLeasingBpkbHandover($salesOrder);
        }
        \DB::transaction(function() use ($salesOrders) {
            foreach ($salesOrders as $salesOrder) {
                $salesOrder->save();
            }
            
            $this->registrationBatch->closed_at = \Carbon\Carbon::now();
            $this->registrationBatch->assignEntityData('closer');
            $this->registrationBatch->save();
        });
       
        return $this->registrationBatch;
    }
    protected function assignLeasingBpkbHandover($salesOrder) {
        
        $customerHandover = $salesOrder->polReg;
       
        $customerHandover['customer_handovers']['BPKB'] = [
            'username' => \ParsedJwt::getByKey('name'),
            'receiver_name' => $this->registrationBatch->receiver_name,
            'leasing_bpkb_submission_id' => $this->registrationBatch->id,
            'timestamp' => \Carbon\Carbon::now()->timestamp
        ];

        $salesOrder->polReg = $customerHandover;
    }
    
}
