<?php

namespace Gelora\PolReg\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class RegistrationController extends Controller {

    protected $registration;

    public function __construct() {
        parent::__construct();
        $this->registration = new \Gelora\PolReg\App\Registration\RegistrationModel;

        $this->transformer = new \Gelora\PolReg\App\Registration\Transformers\RegistrationTransformer();
    }

    public function index(Request $request) {

        $query = $this->registration->newQuery();

        if ($request->has('sales_order_id')) {
            $query->where('sales_order_id', $request->get('sales_order_id'));
        }

        $query->orderBy('created_at', 'desc');

        if ($request->has('paginate')) {

            $registrations = $query->paginate((int) $request->get('paginate', 20));
            return $this->formatCollection($registrations, [], $registrations);
        } else {

            $registrations = $query->get();
            return $this->formatCollection($registrations);
        }
    }

    public function show($id) {

        $registration = $this->registration->find($id);

        return $this->formatItem($registration);
    }

}
