<?php

namespace Gelora\PolReg\App\LeasingBpkbSubmissionBatch\Managers\Actioners;

use Gelora\PolReg\App\LeasingBpkbSubmissionBatch\LeasingBpkbSubmissionBatchModel;

class OnClose {

    protected $registrationBatch;

    public function __construct(LeasingBpkbSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function action() {


        $this->registrationBatch->closed_at = \Carbon\Carbon::now();
        $this->registrationBatch->assignEntityData('closer');
        $this->registrationBatch->save();
        return $this->registrationBatch;
    }        
    //     $registrations = $this->registrationBatch->registrations;
    //     foreach ($registrations as $registration) {
    //         $this->assignLeasingBpbkHandover($registration);
    //     }

    //     \DB::transaction(function() use ($registrations) {

    //         foreach ($registrations as $registration) {
    //             $registration->save();
    //         }

    //         $this->registrationBatch->closed_at = \Carbon\Carbon::now();
    //         $this->registrationBatch->assignEntityData('closer');
    //         $this->registrationBatch->save();
    //     });

    //     return $this->registrationBatch;
    // }

    // protected function assignLeasingBpbkHandover($registration) {

    //     $customerHandover = $registration->customer_handovers;

    //     $customerHandover['BPKB'] = [
    //         'username' => \ParsedJwt::getByKey('name'),
    //         'receiver_name' => $this->registrationBatch->receiver_name,
    //         'registration_leasing_bpkb_submission_batch_id' => $this->registrationBatch->id,
    //         'timestamp' => \Carbon\Carbon::now()->timestamp
    //     ];

    //     $registration->customer_handovers = $customerHandover;
    // }

}
