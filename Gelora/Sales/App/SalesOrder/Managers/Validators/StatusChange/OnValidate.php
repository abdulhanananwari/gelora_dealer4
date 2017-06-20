<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\StatusChange;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnValidate {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    /*
     * Data yg perlu divalidasi:
     * - Kelengkapan data customer (KTP dan entity id terdaftar)
     *      - Jika minta faktur pajak, NPWP diupload
     * - Kelengkapan data registration (KTP dan entity id terdaftar)
     *      Jika on the road:
     *      - KTP sudah diupload
     * - Jika kredit:
     *      - PO sudah lengkap dan divalidasi
     * - Pembayaran
     *      - Pembayaran (dikurangi pokok hutang leasing) sudah cukup     *      
     * - CDDB
     *      - Data CDDB sudah lengkap dan closed
     *      
     */

    public function validate() {

        $attrVal = $this->validateAttributes();
        if ($attrVal !== true) {
            return $attrVal;
        }

        if ($this->salesOrder->payment_type == 'credit' && is_null($this->salesOrder->leasingOrder)) {
            return ['Leasing order harus dipilih dulu untuk penjualan kredit'];
        }
        
        if ($this->salesOrder->payment_type == 'credit') {

            $leasingOrderValidation = $this->checkIfPoIsValid();
            if ($leasingOrderValidation !== true) {
                return $leasingOrderValidation;
            }
        }

        $plafondValidation = $this->checkPlafond();
        if ($plafondValidation !== true) {
            return $plafondValidation;
        }

        $balanceValidation = $this->calculateBalance();
        if ($balanceValidation !== true) {
            return ['Pendapatan belum sesuai dengan pembayaran + piutang. Sesisih Rp ' . number_format($balanceValidation)];
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
            return $balance;
        }
    }

    protected function checkIfPoIsValid() {

        $setting = \Setting::retrieve()->data('BUSINESS_PROCEDURES')['data_1'];
        $required = !empty($setting['LEASING_ORDER_MUST_BE_COMPLETE']) ?
                $setting['LEASING_ORDER_MUST_BE_COMPLETE'] : false;

        if ($required && !$this->salesOrder->selectedLeasingOrder->validate()->status()->validatedAndPoReceived()) {
            return ['PO belum lengkap dan divalidasi'];
        }

        return true;
    }

    protected function checkPlafond() {

        if (request()->get('bypass_plafond_required_validation') != 'true') {

            if (!$this->salesOrder->plafond) {
                return [
                        ['text' => 'Kode plafond belum diinput. Yakin lanjutkan?',
                        'type' => 'confirm',
                        'if_confirmed' => 'bypass_plafond_required_validation']
                ];
            }
        }

        $plafond = $this->salesOrder->retrieve()->plafond();

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
            return ['Check validation plafond gagal. SERVER VALIDASI ERROR'];
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return ['Check validation plafond gagal. CLIENT ERROR'];
        }


        return true;
    }

}
