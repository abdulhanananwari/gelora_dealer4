<?php

namespace Gelora\PolReg\App\LeasingBpkbSubmissionBatch\Managers\Actioners;

use Gelora\PolReg\App\LeasingBpkbSubmissionBatch\LeasingBpkbSubmissionBatchModel;

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
        
        $itemName = 'BPKB';

        $outgoing = new \Solumax\PhpHelper\App\Mongo\SubDocument;
        $outgoing->name = $itemName;
        $outgoing->receiver_name = $this->registrationBatch->mainLeasing['name'];
        $outgoing->receiver_id = $this->registrationBatch->mainLeasing['id'];
        $outgoing->leasing_bpkb_submission_batch_id = $this->registrationBatch->id;
        $outgoing->creator = $this->registrationBatch->assignEntityData();
        
        $polReg = $salesOrder->subDocument()->polReg();
        $polReg->set('items.' . $itemName . '.outgoing', $outgoing);

        $salesOrder->polReg = $polReg;

        return $salesOrder;
    }
    
}
