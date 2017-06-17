<?php

namespace Gelora\CreditSales\Http\Middlewares;

use Closure;

class LeasingPersonnelAccess {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        
        $request->merge(array_merge($request->all(), [
            'leasing_personnel_access' => true
        ]));
        
        return $next($request);
    }

}
