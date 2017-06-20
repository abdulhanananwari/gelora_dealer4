<?php

namespace Gelora\Sales\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class ProspectController extends Controller {

    protected $prospect;

    public function __construct() {
        parent::__construct();
        $this->prospect = new \Gelora\Sales\App\Prospect\ProspectModel();

        $this->transformer = new \Gelora\Sales\App\Prospect\Transformers\ProspectTransformer();
        $this->dataName = 'prospects';
    }

    public function index(Request $request) {

        $query = $this->prospect->newQuery();
        
        if ($request->has('sales_personnel_access')) {
            if ($request->get('sales_personnel_access')['team']) {
                $query->where('salesPersonnel.team_id', $request->get('sales_personnel_access')['team']['id']);
            } else if ($request->get('sales_personnel_access')['personnel']) {
                $query->where('salesPersonnel.id', $request->get('sales_personnel_access')['personnel']['id']);
            }
        }

        if ($request->has('status')) {
            switch ($request->get('status')) {
                case 'open':
                    $query->whereNull('closed_at');
                    break;
                case 'sales_order_request_created':
                    $query->whereNotNull('closed_at')
                            ->whereNull('create_sales_order_responded_at')
                            ->where('create_sales_order_request', true);
                    break;
                case 'sales_order_request_not_created':
                    $query->whereNotNull('closed_at')
                            ->where('create_sales_order_request', false);
                    break;
                case 'sales_order_request_accepted':
                    $query->whereNotNull('create_sales_order_responded_at')
                            ->whereNotNull('sales_order_id');
                    break;
                case 'sales_order_request_rejected':
                    $query->whereNotNull('create_sales_order_responded_at')
                            ->whereNull('sales_order_id');
                    break;
            }
        }

        if ($request->has('from')) {
            $from = \Carbon\Carbon::createFromFormat('Y-m-d', $request->get('from'))->startOfDay();
            $query->where('created_at', '>=', $from);
        }

        if ($request->has('until')) {
            $until = \Carbon\Carbon::createFromFormat('Y-m-d', $request->get('until'))->endOfDay();
            $query->where('created_at', '<=', $until);
        }

        if ($request->has('customer_name')) {
            $query->where('customer.name', 'LIKE', '%' . $request->get('customer_name') . '%');
        }

        if ($request->has('customer_phone_number')) {
            $query->where('customer.phone_number', 'LIKE', '%' . $request->get('customer_phone_number') . '%');
        }

        if ($request->has('sales_personnel_user_id')) {
            $query->where('salesPersonnel.user.id', (int) $request->get('sales_personnel_user_id'));
        }

        if ($request->has('sales_personnel_id')) {
            $query->where('salesPersonnel.id', (int) $request->get('sales_personnel_id'));
        }

        if ($request->get('closed') == 'true') {
            $query->whereNotNull('closed_at');
        }

        $prospects = $query->orderBy('id', $request->get('order', 'desc'))
                ->paginate((int) $request->get('paginate', 20));

        return $this->formatCollection($prospects, [], $prospects);
    }

    public function get($id) {

        $prospect = $this->prospect->find($id);
        return $this->formatItem($prospect);
    }

    public function store(Request $request) {

        $prospect = $this->prospect->assign()->onCreateAndUpdate($request);

        $validation = $prospect->validate()->onCreate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $prospect->action()->onCreate();

        return $this->formatItem($prospect);
    }

    public function update($id, Request $request) {

        $prospect = $this->prospect->find($id);
        $prospect->assign()->onCreateAndUpdate($request);

        $validation = $prospect->validate()->onUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $prospect->action()->onUpdate();

        return $this->formatItem($prospect);
    }

    public function close($id, Request $request) {

        $prospect = $this->prospect->find($id);
        $prospect->assign()->onClose($request);

        $validation = $prospect->validate()->onClose();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $prospect->action()->onClose();

        return $this->formatItem($prospect);
    }

    public function respond($id, Request $request) {

        $prospect = $this->prospect->find($id);
        $prospect->assign()->onRespond($request);

        $validation = $prospect->validate()->onRespond();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $prospect->action()->onRespond();

        return $this->formatItem($prospect);
    }

}
