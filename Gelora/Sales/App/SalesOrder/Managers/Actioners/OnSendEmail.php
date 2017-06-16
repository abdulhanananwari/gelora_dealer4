<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnSendEmail {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function action() {
      
            try{

                \Mail::to($this->salesOrder->customer['email'])
                        ->send(new \Gelora\Sales\App\SalesOrder\Managers\Mails\SalesOrderSendEmail($this->salesOrder));
            } catch (\Swift_RftComplianceException $e) {

            }

      }     

    }

