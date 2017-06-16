<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class SalesOrderSendEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    protected $salesOrder;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(SalesOrderModel $salesOrder)
    {
        $this->salesOrder = $salesOrder;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        

    $viewData = [
        'salesOrder' => $this->salesOrder->generate()->spkPdf()
    ];

    return $this->view('gelora.sales::emailSpk')
                ->with('viewData', $viewData);

    }

     
}