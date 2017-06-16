<?php

namespace Gelora\CreditSales\App\LeasingOrder\Managers\Validators;

use Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel;

class OnValidate {

    protected $leasingOrder;
    
    /*
     * Data yg perlu divalidasi:
     *      - Nominal OTR - DP PO = pokok hutang leasing (sudah dibuat)
     *      - Pokok hutang leasing sudah dicatat (BATAL, POKOK HUTANG LEASING DICATAT SAAT BAST SERAH TERIMA KENDARAAN)
     *      - Data PO sudah lengkap (sudah dibuat)
     */

    public function __construct(LeasingOrderModel $leasingOrder) {
        $this->leasingOrder = $leasingOrder;
    }

    public function validate() {


        $basicValidation = $this->leasingOrder->validate()->onCreateOrUpdate();
        if ($basicValidation !== true) {
             return $basicValidation;
        }
        
        if (is_null($this->leasingOrder->sales_order_id)) {
            return ['PO belum di assign ke penjualan'];
        }

        if (($this->leasingOrder->on_the_road - $this->leasingOrder->leasing_payable) != $this->leasingOrder->dp_po) {
            return ['Piutang Leasing tidak sesuai dengan (OTR - DP PO)'];
        }
        
        $poIsUploaded = $this->checkIfPoIsUploaded();
        if ($poIsUploaded !== true) {
            return $poIsUploaded;
        }
        
//        if (!$this->checkLeasingPayable()) {
//            return ['Pokok Hutang Leasing belum tercatat'];
//        }
        
        // if ($this->leasingOrder->due['amount'] != $this->leasingOrder->leasing_payable) {
        //    return ['Pokok piutang leasing yang tercatat tidak sama'];
        // }
        

        return true;
    }

    protected function checkLeasingPayable() {

        return \SolTransaction::due()->index()
                ->filter('type', 'R')
                ->filter('transactable_type', 'LeasingOrder')
                ->filter('transactable_id', $this->leasingOrder->id)
                ->filter('transactable_app', config('app.name'))
                ->run();
    }
    
    protected function checkIfPoIsUploaded() {

        $setting = \Setting::retrieve()->data('BUSINESS_PROCEDURES')['data_1'];
        $required = !empty($setting['LEASING_ORDER_MUST_BE_COMPLETE']) ?
                $setting['LEASING_ORDER_MUST_BE_COMPLETE'] : false;

        if ($required && is_null($this->leasingOrder->po_file_uuid)) {
            return ['PO harus diupload dulu'];
        }

        return true;
    }

}
