<?php

namespace Gelora\HumanResource\Http\Middlewares;

use Closure;

class SalesPersonnelAccess {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $strict = false) {

        $cacheName = 'sales_data_' . \ParsedJwt::getByKey('selected_tenant_id') . '_' . \ParsedJwt::getByKey('sub');

        $salesPersonnel = \Cache::remember($cacheName, 60, function() {

                    $personnel = \Gelora\HumanResource\App\Personnel\PersonnelModel::
                            where('user.id', \ParsedJwt::getByKey('sub'))->first();

                    $team = \Gelora\HumanResource\App\Team\TeamModel::
                            where('leader.user.id', \ParsedJwt::getByKey('sub'))->first();

                    return [
                        'personnel' => !empty($personnel) ? $personnel : null,
                        'team' => !empty($team) ? $team : null
                    ];
                });

        if ($strict && is_null($salesPersonnel['personnel'])) {
            return response('Data sales tidak ditemukan', 403);
        }

        $request->merge(array_merge($request->all(), [
            'sales_personnel_access' => $salesPersonnel,
        ]));

        return $next($request);
    }

}
