<?php

namespace Gelora\Base\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class AccountController extends Controller {
    
    protected $account;
    
    public function __construct() {
        parent::__construct();
        $this->account = new \Gelora\Base\App\Account\AccountModel();
        
        $this->transformer = new \Gelora\Base\App\Account\Transformers\AccountTransformer();
        $this->dataName = 'accounts';
    }
    
    public function index(Request $request) {
        
        $query = $this->account->newQuery();
        
        $accounts = $query->get();
        
        return $this->formatCollection($accounts);
    }
}
