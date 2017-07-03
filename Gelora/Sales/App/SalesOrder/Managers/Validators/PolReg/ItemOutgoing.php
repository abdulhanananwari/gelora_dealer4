<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\PolReg;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class ItemOutgoing {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate($itemName, \Illuminate\Http\Request $request) {

        $incoming = $this->salesOrder->subDocument()->polReg()->get('items.' . $itemName . '.outgoing');
        if (!empty($incoming)) {
            return ['Penyerahan sudah dibuat sebelumnya'];
        }
        if ($itemName == 'BPKB' && $this->salesOrder->payment_type == 'credit') {
            return ['Penjualan adalah kredit, BPKB tidak dapat diserahkan langsung ke customer '];
        }


        if (in_array($itemName, ['STNK', 'BPKB']) && request()->get('bypass_validate_balance') != 'true') {

            $balanceValidation = $this->validateBalance();
            if ($balanceValidation !== true) {
                return $balanceValidation;
            }
        }

        $requestValidation = $this->validateRequest($request);
        if ($requestValidation->fails()) {
            return $requestValidation->errors()->all();
        }

        return true;
    }

    protected function validateBalance() {

        $balance = $this->salesOrder->calculate()->salesOrderBalance();

        if ($balance['payment_unreceived'] > 0) {
            return [
                    [
                    'text' => 'Pembayaran untuk SPK masih kurang Rp ' . number_format($balance['payment_unreceived']) . '. Yakin lanjutkan?',
                    'type' => 'confirm',
                    'if_confirmed' => 'bypass_validate_balance'
                ]
            ];
        } else if ($balance['payment_unreceived'] < 0) {
            return [
                    [
                    'text' => 'Pembayaran untuk SPK berlebih Rp ' . number_format(abs($balance['payment_unreceived'])) . '. Yakin lanjutkan?',
                    'type' => 'confirm',
                    'if_confirmed' => 'bypass_validate_balance'
                ]
            ];
        }

        return true;
    }

    protected function validateRequest($request) {

        return \Validator::make($request->all(), [
                    'receiver_name' => 'required',
        ]);
    }

}
