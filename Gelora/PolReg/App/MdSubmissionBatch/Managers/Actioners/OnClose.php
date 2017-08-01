<?php

namespace Gelora\PolReg\App\MdSubmissionBatch\Managers\Actioners;

use Gelora\PolReg\App\MdSubmissionBatch\MdSubmissionBatchModel;

class OnClose {
    
    protected $registrationBatch;
    
    public function __construct(MdSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }
    
    public function action() {
        
        $this->registrationBatch->closed_at = \Carbon\Carbon::now();
        $this->registrationBatch->assignEntityData('closer');
        
        $this->generateStrings();
        $this->registrationBatch->email_subject = $this->registrationBatch
                ->retrieve()->emailSubject();
        
        $this->registrationBatch->save();
        
        return $this->registrationBatch;
    }
    
    protected function generateStrings() {
        
        $this->registrationBatch->strings = [
            'spk_ids' => $this->registrationBatch->fileGenerate()->spkId(),
            'cddb' => $this->registrationBatch->fileGenerate()->cddb(),
            'udstk' => $this->registrationBatch->fileGenerate()->udstk(),
            'udsls' => $this->registrationBatch->fileGenerate()->udsls(),
        ];
    }
}
