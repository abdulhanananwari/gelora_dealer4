<?php

namespace Gelora\Sales\App\Prospect\Managers\Assigners;

use Gelora\Sales\App\Prospect\ProspectModel;

class OnRespond {

    protected $prospect;

    public function __construct(ProspectModel $prospect) {
        $this->prospect = $prospect;
    }

    public function assign(\Illuminate\Http\Request $request) {

        $keys = [
            'create_sales_order_response_note',
        ];

        $this->prospect->fill($request->only($keys));

        $this->prospect->create_sales_order_response = $request->get('create_sales_order_response') == 'true';

        return $this->prospect;
    }

}
