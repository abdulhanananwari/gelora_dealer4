<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\StatusChange;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnValidate {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {

        if (request()->get('bypass_attributes_validation') != 'true') {

            $attrVal = $this->validateAttributes();
            if ($attrVal !== true) {

                return [
                        [
                        'type' => 'confirm',
                        'text' => implode("\n", array_merge($attrVal, ['Yakin lanjutkan tanpa validasi data?'])),
                        'if_confirmed' => 'bypass_attributes_validation'
                    ]
                ];
            }
        }


        if ($this->salesOrder->payment_type == 'credit' && is_null($this->salesOrder->leasingOrder->dp_po)) {

            return ['Leasing order harus diinput dulu untuk penjualan kredit'];
        }

        if (request()->get('bypass_plafond_required_validation') != 'true') {

            $plafondValidation = $this->checkPlafond();
            if ($plafondValidation !== true) {
                return $plafondValidation;
            }
        }

        if (request()->get('bypass_balance_validation') != 'true') {

            $balanceValidation = $this->calculateBalance();
            if ($balanceValidation !== true) {
                return $balanceValidation;
            }
        }

        return true;
    }

    protected function validateAttributes() {

        // Customer harus lengkap
        $customerValidation = $this->salesOrder->validate()->data()->customer(['customer.id_file_uuid']);
        if ($customerValidation !== true) {
            return $customerValidation;
        }

        // Harga / deal harus lengkap
        $priceValidation = $this->salesOrder->validate()->data()->price();
        if ($priceValidation !== true) {
            return $priceValidation;
        }

        if ($this->salesOrder->sales_condition == 'isi') {
            $registrationValidation = $this->salesOrder->validate()->data()->registration();
            if ($registrationValidation !== true) {
                return $registrationValidation;
            }
        }
        if (!empty($this->salesOrder->mediator_fee)) {
            $mediatorValidation = $this->salesOrder->validate()->data()->mediator();
            if ($mediatorValidation !== true) {
                return $mediatorValidation;
            }
        }
        return true;
    }

    protected function calculateBalance() {

        $balance = $this->salesOrder->calculate()->SalesOrderBalance()['payment_unreceived'];

        if ($balance == 0) {
            return true;
        } else {
            return [
                    [
                    'type' => 'confirm',
                    'text' => 'Masih ada kekurangan pembayaran senilai ' . number_format($balance) . '. Yakin mau lanjutkan validasi?',
                    'if_confirmed' => 'bypass_balance_validation'
                ]
            ];
        }
    }

    protected function checkPlafond() {

        if (!$this->salesOrder->plafond) {
            return [
                    [
                    'text' => 'Kode plafond belum diinput. Yakin lanjutkan?',
                    'type' => 'confirm',
                    'if_confirmed' => 'bypass_plafond_required_validation'
                ]
            ];
        }

        $plafond = base64_decode($this->salesOrder->plafond, true);
        $inputEncoding = 'iso-2022-jp';
        $check = iconv($inputEncoding, 'UTF-8//IGNORE', $plafond);

        if ($plafond != $check) {
            return ['Plafond yang di input salah'];
        }

        try {

            $client = new \GuzzleHttp\Client();
            $client->request('GET', env('PLAFOND_SERVER_DOMAIN') . 'price/api/price/base64/' . $this->salesOrder->plafond, [
                'query' => [
                    'jwt' => \ParsedJwt::getJwtString()
                ]
            ]);
        } catch (\GuzzleHttp\Exception\ServerException $e) {

            return ['Check validation plafond gagal. SERVER ERROR'];
        } catch (\GuzzleHttp\Exception\ClientException $e) {

            return ['Check validation plafond gagal. CLIENT ERROR'];
        }


        return true;
    }

}
