<?php

namespace Gelora\PolReg\Http\Controllers\Api\Registration;

use Gelora\PolReg\Http\Controllers\Api\RegistrationController;
use Illuminate\Http\Request;

class ActionController extends RegistrationController {

    protected $registration;

    public function __construct() {
        parent::__construct();
    }

    public function generateFromDelivery(Request $request) {

        $delivery = \Gelora\Delivery\App\Delivery\DeliveryModel::
                find($request->get('delivery_id'));

        $registration = $this->registration->assign()->fromDelivery($delivery);

        $validation = $registration->validate()->onCreate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $registration->action()->onCreate();

        return $this->formatItem($registration);
    }

}
