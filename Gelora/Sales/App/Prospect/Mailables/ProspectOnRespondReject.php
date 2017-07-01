<?php

namespace Gelora\Sales\App\Prospect\Mailables;

use Illuminate\Mail\Mailable;
use Gelora\Sales\App\Prospect\ProspectModel;

class ProspectOnRespondReject extends Mailable {

    protected $prospect;

    public function __construct(ProspectModel $prospect) {
        $this->prospect = $prospect;
    }

    public function build() {

        return $this->to($this->prospect->getAttribute('salesPersonnel.email'))
                        ->text('Proses prospek ke SPK direject')
                        ->subject('Proses prospek ke SPK direject');
    }

}
