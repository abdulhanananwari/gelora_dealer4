<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\PolReg;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class ItemIncoming {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action($itemName, \Illuminate\Http\Request $request) {

        $incoming = [
            'note' => $request->get('note'),
            'creator' => $this->salesOrder->assignEntityData()
        ];

        $item = $this->salesOrder->getAttribute('polReg.items.' . $itemName);
        $item['name'] = $itemName;
        $item['incoming'] = $incoming;
        $this->salesOrder->setAttribute('polReg.items.' . $itemName, $item);

        $this->assignDetails($itemName, $request);

        $this->salesOrder->save();
        return;
    }

    protected function assignDetails($itemName, $request) {

        // Kalau Faktur simpan nomor Faktur
        if ($itemName == 'Faktur') {
            $this->salesOrder->setAttribute('polReg.faktur_number', $request->get('faktur_number'));
        }

        // Kalau STNK simpan Pol Reg
        if ($itemName == 'STNK') {
            $this->salesOrder->setAttribute('polReg.pol_reg', $request->get('pol_reg'));
        }

        // Kalau BPKB simpan Nomor BPKB
        if ($itemName == 'BPKB') {
            $this->salesOrder->setAttribute('polReg.bpkb_number', $request->get('bpkb_number'));
        }
    }
    

}
