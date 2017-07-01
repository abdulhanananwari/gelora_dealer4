<?php

namespace Gelora\Sales\App\Prospect\Managers\Actioners;

use Gelora\Sales\App\Prospect\ProspectModel;

class OnRespond {

    protected $prospect;

    public function __construct(ProspectModel $prospect) {
        $this->prospect = $prospect;
    }

    public function action() {

        $this->prospect->create_sales_order_responded_at = \Carbon\Carbon::now();
        $this->prospect->assignEntityData('create_sales_order_responder');

        if ($this->prospect->create_sales_order_response) {
            $this->generateSalesOrder();
        } else {
            $this->prospect->closed_at = null;
            $this->notifyToEmailOnReject();
        }

        $this->prospect->save();
    }

    protected function generateSalesOrder() {

        $salesOrder = new \Gelora\Sales\App\SalesOrder\SalesOrderModel();
        $salesOrder->assign()->fromProspect($this->prospect);

        $salesOrder->action()->onCreate();

        $this->prospect->sales_order_id = $salesOrder->id;

        return $salesOrder;
    }

    protected function notifyToEmailOnReject() {
        
        $mailable = new \Gelora\Sales\App\Prospect\Mailables\ProspectOnRespondReject($this->prospect);
        
        \Mail::to($this->prospect->getAttribute('salesPersonnel.email'))
                ->send($mailable);
    }
    

}
