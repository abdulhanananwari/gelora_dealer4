<?php

namespace Gelora\PolReg\Http\Controllers\Report;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;
use Solumax\PhpHelper\Http\ControllerExtensions\CsvParseAndCreate;
use MongoDB\BSON\UTCDateTime;
 
class RegistrationController extends Controller {
    use CsvParseAndCreate;
    
    protected $transformer;

    public function __construct() {
        parent::__construct();
        $this->registration = new \Gelora\PolReg\App\Registration\RegistrationModel;

        $this->transformer = new \Gelora\PolReg\App\Registration\Transformers\RegistrationReportTransformer();
    }

    public function index(Request $request) {
        $query = [
            
             [
                '$lookup'=>[
                    'from'=>'sales_orders',
                    'localField' => 'sales_order_id',
                    'foreignField' => 'id',
                    'as' => 'sales_order'
                ]
            ],
            ['$unwind' => ['path' => '$sales_order','preserveNullAndEmptyArrays' => true]],           
            [
                '$lookup'=>[
                    'from'=>'registration_agency_invoices',
                    'localField' => 'registration_agency_invoice_id',
                    'foreignField' => 'id',
                    'as' => 'registration_agency_invoice'
                ]
            ],
            ['$unwind' => ['path' => '$registration_agency_invoice','preserveNullAndEmptyArrays' => true]],
            [
                '$lookup'=>[
                    'from'=>'registration_agency_submission_batches',
                    'localField' => 'registration_agency_submission_batch_id',
                    'foreignField' => 'id',
                    'as' => 'registration_agency_submission_batch'
                ]
            ],
            ['$unwind' => ['path' => '$registration_agency_submission_batch','preserveNullAndEmptyArrays' => true]],
            [
                '$lookup'=>[
                    'from'=>'registration_leasing_bpkb_submission_batches',
                    'localField' => 'registration_leasing_bpkb_submission_batch_id',
                    'foreignField' => 'id',
                    'as' => 'registration_leasing_bpkb_submission_batch'
                ]
            ],
            ['$unwind' => ['path' => '$registration_leasing_bpkb_submission_batch','preserveNullAndEmptyArrays' => true]],
            
        ];
        if($request->has('from')){
        
            $from = new UTCDateTime(\Carbon\Carbon::createFromFormat('Y-m-d', $request->get('from'))->startOfDay()->getTimestamp() * 1000);
            $subquery =['$match' => ['created_at' => ['$gte'=> $from]]];
            $query[]=$subquery;
        }
        if($request->has('until')){
        
            $from = new UTCDateTime(\Carbon\Carbon::createFromFormat('Y-m-d', $request->get('until'))->endOfDay()->getTimestamp() * 1000);
            $subquery =['$match' => ['created_at' => ['$lte'=> $from]]];
            $query[]=$subquery;
        }
        if($request->has('main_leasing_id')){
            $subquery = ['$match' => ['registration_leasing_bpkb_submission_batch.mainLeasing.id' => (int) $request->get('main_leasing_id')]];
            $query[]=$subquery;
        }
        if($request->has('sub_leasing_id')){
            $subquery = ['$match' => ['registration_leasing_bpkb_submission_batch.subLeasing.id' => (int) $request->get('sub_leasing_id')]];
            $query[]=$subquery;
        }
        if($request->has('agent_id')){
            $subquery = ['$match' => ['registration_agency_submission_batch.agent.id' => (int) $request->get('agent_id')]];
            $query[]=$subquery;
        }
        if($request->has('agent_name')){
            $subquery = ['$match' => ['registration_agency_submission_batch.agent.name' =>  $request->get('agent_name')]];
            $query[]=$subquery;
        }
        if ($request->has('payment_type')) {
            
            $subquery = ['$match' => ['sales_order.payment_type' =>  $request->get('payment_type')]];
            $query[]=$subquery;
        }
        
        $registrations = $this->registration->raw(function($collection) use ($query) {
            return $collection->aggregate(
                            $query
            );
        });
       // return response()->json($registrations);
        return $this->createCsv($this->transformer->transformCollection($registrations));

    }

}  
