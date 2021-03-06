<?php

namespace Gelora\PolReg\App\MdSubmissionBatch\Managers\Retrievers;

use Gelora\PolReg\App\MdSubmissionBatch\MdSubmissionBatchModel;

class EmailSubject {

    protected $registrationBatch;

    public function __construct(MdSubmissionBatchModel $registrationBatch) {

        $this->registrationBatch = $registrationBatch;
    }

    public function retrieve() {

        $subjectEmail = \Setting::where('object_type', 'SUBJECT_EMAIL')->first()->data_1;

        $formatData = $subjectEmail['SUBJECT_1'] . '-' .
                $subjectEmail['SUBJECT_2'] . '-' .
                date_format($this->registrationBatch->closed_at, 'ymd') . '-' .
                date_format($this->registrationBatch->closed_at, 'ymdHi');

        return $formatData;
    }

}
