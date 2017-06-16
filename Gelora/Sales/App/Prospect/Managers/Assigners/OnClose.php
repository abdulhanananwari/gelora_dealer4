<?php

namespace Gelora\Sales\App\Prospect\Managers\Assigners;

use Gelora\Sales\App\Prospect\ProspectModel;

class OnClose {

    protected $prospect;

    public function __construct(ProspectModel $prospect) {
        $this->prospect = $prospect;
    }

    public function assign(\Illuminate\Http\Request $request) {

        $this->prospect->assign()->onCreateAndUpdate($request);

        $keys = [
            'closing_note',
        ];

        $this->prospect->fill($request->only($keys));

        $this->prospect->create_sales_order_request = $request->get('create_sales_order_request') == 'true';

        return $this->prospect;
    }

}
