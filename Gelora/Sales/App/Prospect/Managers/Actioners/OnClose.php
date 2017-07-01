<?php

namespace Gelora\Sales\App\Prospect\Managers\Actioners;

use Gelora\Sales\App\Prospect\ProspectModel;

class OnClose {

    protected $prospect;

    public function __construct(ProspectModel $prospect) {
        $this->prospect = $prospect;
    }

    public function action() {

        $this->prospect->closed_at = \Carbon\Carbon::now();
        $this->prospect->assignEntityData('closer');

        $this->prospect->save();

        if ($this->prospect->create_sales_order_request) {
            $this->notifyToSlack();
        }
    }

    protected function notifyToSlack() {

        $adminSlackChannels = collect(\Setting::retrieve()->data('ADMIN_SLACK_CHANNELS')->data_1);

        $client = new \Solumax\PhpHelper\Slack\Client($adminSlackChannels['PROSPECT_SPK']['webhook'], [
            'username' => 'Dealer App',
        ]);

        $client->send('Prospek ditutup. Request untuk dibuat SPK', [
                [
                'title' => 'Nama Customer',
                'value' => $this->prospect->getAttribute('customer.name'),
                'short' => true
            ], [
                'title' => 'Link',
                'value' => url('/sales/redirect-app/prospect/?id=' . $this->prospect->id),
                'short' => true
            ], [
                'title' => 'Nama Sales',
                'value' => $this->prospect->getAttribute('salesPersonnel.entity.name'),
                'short' => true
            ]
        ]);
    }

}
