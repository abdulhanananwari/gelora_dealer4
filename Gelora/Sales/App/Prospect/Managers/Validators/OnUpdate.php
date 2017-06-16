<?php

namespace Gelora\Sales\App\Prospect\Managers\Validators;

use Gelora\Sales\App\Prospect\ProspectModel;

class OnUpdate {

    protected $prospect;

    public function __construct(ProspectModel $prospect) {
        $this->prospect = $prospect;
    }

    public function validate() {

        $onCreateValidation = $this->prospect->validate()->onCreate();
        if ($onCreateValidation !== true) {
            return $onCreateValidation;
        }

        if ($this->prospect->sales_condition == 'kosong' && $this->prospect->payment_type == 'credit') {
            return ['Tidak dapat menggunakan kredit leasing untuk kondisi jual kosong'];
        }

        return true;
    }

}
