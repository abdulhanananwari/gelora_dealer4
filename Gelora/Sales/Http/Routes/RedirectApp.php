<?php

Route::group(['prefix' => 'redirect-app'], function() {

    Route::get('sales-order/', function() {

        $viewData = [
            'link' => request()->url() . '/redirected/?id=' . request()->get('id') . '&jwt=',
            'id' => request()->get('id', '')
        ];

        return view('gelora.sales::redirect')
                        ->with('viewData', $viewData);
    });

    $middlewares = ['wala.jwt.autoParse.parser', 'wala.jwt.autoParse.validation', 'auth.db.overwrite', 'salesPersonnelAccess'];

    Route::middleware($middlewares)->get('sales-order/redirected', function() {

        $tumr = new \Solumax\AuthClient\Data\TenantUserModuleRole();
        if ($tumr->check('ADMIN_ACCESS')) {
            $link = "/gelora/sales/admin/index.html#/salesOrder/show/" .
                    request("id", "");
            return response('', 302, ['Location' => $link]);
        }

        if (request()->has('sales_personnel_access')) {
            $link = "/gelora/sales/personnel/index.html#/salesOrder/show/" .
                    request("id", "");
            return response('', 302, ['Location' => $link]);
        }

        return 'Anda tidak dapat mengakses halaman ini';
    });
});
