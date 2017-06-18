<?php

namespace Gelora\PolReg\App\RegistrationMdSubmissionBatch\Managers\FileGenerators;

use Gelora\PolReg\App\RegistrationMdSubmissionBatch\RegistrationMdSubmissionBatchModel;

class Cddb {

    protected $registrationBatch;

    public function __construct(RegistrationMdSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function fileGenerate() {

        $registrations = $this->registrationBatch->registrations;

        $file = tmpfile();

        foreach ($registrations as $registration) {
            fwrite($file, $registration->delivery->salesOrder->cddb->string['cddb']);
            fwrite($file, "\n");
        }

        fseek($file, 0);
        return $file;
    }

}
