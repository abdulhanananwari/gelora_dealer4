<?php

namespace Gelora\Base\App\Unit\Managers\Validators\OnCreate;

use Gelora\Base\App\Unit\UnitModel;

class FromPurchase {
    
    protected $unit;
    
    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }

    public function validate() {
        
        $purchaseSimpleValidation = $this->unit->validate()->onCreate()->fromPurchaseSimple();
        if ($purchaseSimpleValidation !== true) {
            return $purchaseSimpleValidation;
        }

        $purchaseValidation = $this->validatePurchase();
        if ($purchaseValidation !== true) {
            return $purchaseValidation;
        }

        return true;
    }

    protected function validatePurchase() {

        $purchase = $this->unit->purchase;

        if (empty($purchase)) {
            return ['Pembelian tidak ditemukan. Unit tidak bisa ditambahkan'];
        }

        try {

            if ($this->unit->sj_number != $purchase->suratJalan['id']) {
                return ['Nomor surat jalan tidak sesuai dengan pembelian'];
            }

            if ($this->unit->nd_number != $purchase->notaDebet['id']) {
                return ['Nomor nota debet tidak sesuai dengan pembelian'];
            }
        } catch (ErrorException $e) {

            return ['ID nota debet atau surat jalan belum lengkap'];
        }

        return true;
    }
}
