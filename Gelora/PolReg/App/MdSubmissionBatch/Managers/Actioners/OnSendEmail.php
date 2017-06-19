<?php

namespace Gelora\PolReg\App\MdSubmissionBatch\Managers\Actioners;

use Gelora\PolReg\App\MdSubmissionBatch\MdSubmissionBatchModel;

class OnSendEmail {

    protected $registrationBatch;

    public function __construct(MdSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function action($emailAddress) {

        $mailable = new \Gelora\PolReg\App\MdSubmissionBatch\Managers\Mails\MdSubmissionBatchSend($this->registrationBatch);

        \Mail::to($emailAddress)->send($mailable);
        
        if (is_null($this->registrationBatch->sent_at)) {
            $this->registrationBatch->sent_at = \Carbon\Carbon::now();
            $this->registrationBatch->save();
        }

        return $this->registrationBatch;
    }

}
