<?php

namespace Gelora\PolReg\App\RegistrationMdSubmissionBatch\Managers\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Gelora\PolReg\App\RegistrationMdSubmissionBatch\RegistrationMdSubmissionBatchModel;

class RegistrationMdSubmissionBatchSend extends Mailable {

    use Queueable,
        SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(RegistrationMdSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {

        //Generate file//
        $cddbFile = $this->registrationBatch->fileGenerate()->cddb();
        $udstkFile = $this->registrationBatch->fileGenerate()->udstk();
        $udslsFile = $this->registrationBatch->fileGenerate()->udsls();
        
        $viewData = [
            'subject' => $this->registrationBatch->retrieve()->emailSubject()
        ];

        $email = $this
                ->text('gelora.polReg::emails.registrationMdSubmissionBatch.send')
                ->subject($this->registrationBatch->retrieve()->emailSubject())
                ->attachData(fread($cddbFile, 1024), $this->registrationBatch->retrieve()->emailSubject() . '.CDDB')
                ->attachData(fread($udstkFile, 1024), $this->registrationBatch->retrieve()->emailSubject() . '.UDSTK')
                ->attachData(fread($udslsFile, 1024), $this->registrationBatch->retrieve()->emailSubject() . '.UDSLS')
                ->with(['viewData' => $viewData]);

        return $email;
    }

}
