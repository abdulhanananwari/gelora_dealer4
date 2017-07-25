<?php

Route::group(['prefix' => 'redirect-app'], function() {
    
    // Lewat sini untuk dilempar ke redirected, redirection dengan jwt
    Route::get('sales-order/', function() {

        $viewData = [
            'link' => request()->url() . '/redirected/?id=' . request()->get('id') . '&jwt=',
            'id' => request()->get('id', '')
        ];

        return view('gelora.sales::redirect')
                        ->with('viewData', $viewData);
    });

    Route::get('prospect/', function() {

        $viewData = [
            'link' => request()->url() . '/redirected/?id=' . request()->get('id') . '&jwt=',
            'id' => request()->get('id', '')
        ];

        return view('gelora.sales::redirect')
                        ->with('viewData', $viewData);
    });

    // Terima redirection dengan jwt
    $middlewares = ['wala.jwt.autoParse.parser', 'wala.jwt.autoParse.validation', 'auth.db.overwrite', 'salesPersonnelAccess'];

    Route::middleware($middlewares)->get('sales-order/redirected', function() {

        if (\SolAuthClient::hasAccess('ADMIN_ACCESS')) {
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

    Route::middleware($middlewares)->get('prospect/redirected', function() {

        if (\SolAuthClient::hasAccess('ADMIN_ACCESS')) {
            $link = "/gelora/sales/admin/index.html#/prospect/show/" .
                    request("id", "");
            return response('', 302, ['Location' => $link]);
        }

        if (request()->has('sales_personnel_access')) {
            $link = "/gelora/sales/personnel/index.html#/prospect/show/" .
                    request("id", "");
            return response('', 302, ['Location' => $link]);
        }

        return 'Anda tidak dapat mengakses halaman ini';
    });
});
