<?php

namespace Gelora\Base\App\SalesExtra\Managers\Assigners;

use Gelora\Base\App\SalesExtra\SalesExtraModel;

class FromRequest {

    protected $salesExtra;

    public function __construct(SalesExtraModel $salesExtra) {
        $this->salesExtra = $salesExtra;
    }

    public function assign(\Illuminate\Http\Request $request) {

        $this->salesExtra->fill($request->only('name', 'type'));

        return $this->salesExtra;
    }

}
