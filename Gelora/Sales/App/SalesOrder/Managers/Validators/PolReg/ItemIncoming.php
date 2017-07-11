<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\PolReg;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class ItemIncoming {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate($itemName, $request) {

        $incoming = $this->salesOrder->subDocument()->polReg()->get('items.' . $itemName . '.incoming');
        if (!empty($incoming)) {
            return ['Penerimaan sudah dibuat sebelumnya'];
        }
        
        $validation = $this->validateDetails($itemName, $request);
        if ($validation !== true) {
            return $validation;
        }
        
        $fakturValidation = $this->validateFakturReceived($itemName);
        if ($fakturValidation !== true) {
            return $fakturValidation;
        }

        return true;
    }

    protected function validateDetails($itemName, $request) {

        // Kalau Faktur simpan Nomor Faktur
        if ($itemName == 'Faktur' && (!$request->has('faktur_number') || strlen($request->get('faktur_number')) < 2)) {
            return ['Nomor Faktur belum diinput / inputan faktur salah. Minimal 2 huruf.'];
        }

        // Kalau STNK simpan Pol Reg
        if ($itemName == 'STNK' && (!$request->has('pol_reg') || strlen($request->get('pol_reg')) < 2)) {
            return ['Pol Reg belum diinput / inputan pol reg salah. Minimal 2 huruf.'];
        }
        
        // Kalau STNK simpan Pol Reg
        if ($itemName == 'BPKB' && (!$request->has('bpkb_number') || strlen($request->get('bpkb_number')) < 2)) {
            return ['Nomor BPKB belum diinput / inputan BPKB salah. Minimal 2 huruf.'];
        }
        
        return true;
    }
    
    protected function validateFakturReceived($itemName) {
        
        if ($itemName != 'Faktur' && !$this->salesOrder->getAttribute('polReg.items.Faktur.incoming.creator')) {
            return ['Gagal. Penerimaan faktur belum diinput'];
        }
        
        return true;
    }

}
