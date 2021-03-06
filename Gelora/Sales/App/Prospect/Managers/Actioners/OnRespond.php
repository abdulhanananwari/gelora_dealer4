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
            $this->notifyToEmailOnApprove();
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
        
        $email = $this->prospect->getAttribute('salesPersonnel.email');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ;
        }
        
        $string = "Proses prospek ke SPK direject \n " . url('sales/redirect-app/prospect/?id=' . $this->prospect->id); 
        
        \Mail::raw($string, function($message) use ($email) {
            $message->to($email)
                    ->subject('Proses prospek ke SPK direject');
        });
    }
    protected function notifyToEmailOnApprove() {
        $email = $this->prospect->getAttribute('salesPersonnel.email');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ;
        }
        
        $string = "Proses prospek ke SPK di Approve Oleh Admin \n " . url('sales/redirect-app/prospect/?id=' . $this->prospect->id); 
        
        \Mail::raw($string, function($message) use ($email) {
            $message->to($email)
                    ->subject('Proses prospek ke SPK di Approve');
        });
    }
    

}
