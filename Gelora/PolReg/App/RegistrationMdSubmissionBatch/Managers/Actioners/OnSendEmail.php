<?php

namespace Gelora\PolReg\App\RegistrationMdSubmissionBatch\Managers\Actioners;

use Gelora\PolReg\App\RegistrationMdSubmissionBatch\RegistrationMdSubmissionBatchModel;

class OnSendEmail {

    protected $registrationBatch;

    public function __construct(RegistrationMdSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function action($emailAddress) {

        $mailable = new \Gelora\PolReg\App\RegistrationMdSubmissionBatch\Managers\Mails\RegistrationMdSubmissionBatchSend($this->registrationBatch);

        \Mail::to($emailAddress)->send($mailable);
        
        if (is_null($this->registrationBatch->sent_at)) {
            $this->registrationBatch->sent_at = \Carbon\Carbon::now();
            $this->registrationBatch->save();
        }

        return $this->registrationBatch;
    }

}
