<?php

namespace Gelora\PolReg\App\MdSubmissionBatch\Managers\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Gelora\PolReg\App\MdSubmissionBatch\MdSubmissionBatchModel;

class MdSubmissionBatchSend extends Mailable {

    use Queueable,
        SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(MdSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {

        $viewData = [
            'subject' => $this->registrationBatch->email_subject
        ];

        $email = $this
                ->text('gelora.polReg::emails.registrationMdSubmissionBatch.send')
                ->subject($this->registrationBatch->retrieve()->emailSubject())
                ->attachData($this->registrationBatch->getAttribute('strings.cddb'), $this->registrationBatch->email_subject . '.CDDB')
                ->attachData($this->registrationBatch->getAttribute('strings.udstk'), $this->registrationBatch->email_subject . '.UDSTK')
                ->attachData($this->registrationBatch->getAttribute('strings.udsls'), $this->registrationBatch->email_subject . '.UDSLS')
                ->with(['viewData' => $viewData]);

        return $email;
    }

}
