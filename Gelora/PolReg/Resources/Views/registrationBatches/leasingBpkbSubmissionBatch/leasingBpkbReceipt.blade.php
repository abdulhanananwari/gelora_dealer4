<!DOCTYPE html>
<html>

<head>
    <title>Bukti Penyerahan BPKB Ke Leasing</title>
    <link rel="stylesheet" type="text/css" href="/standard/bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <style type="text/css">
    .table {
        border-style: none !important;
        border: 0 !important;
    }
    
    .layout-table > tbody > tr > td {
        border-top: 0px !important;
        vertical-align: top;
    }
    
    p {
        margin: 0;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <table class="table layout-table" style="width: 100%;margin-bottom: 5px;">
                    <tr>
                        <td style="width: 10%; padding-right: 10px;">
                            <img style="width: auto; max-height: 5em !important;" class="img-responsive" src="{{ $viewData['tenantInfo']->LOGO }}">
                        </td>
                        <td style="width: 50%;">
                            <p><strong>{{ $viewData['tenantInfo']->TENANT }}</strong></p>
                            <p>{{ $viewData['tenantInfo']->ADDRESS }}</p>
                            <p>{{ $viewData['tenantInfo']->PHONE_NUMBER }}</p>
                        </td>
                        <td style="width: 40%;">
                            <p style="float: right;padding-right: 55px;">No Batch : {{$viewData['registrationBatch']->id}}</p>
                            <img style="width: auto; max-height: 4em !important; float: right;" class="img-responsive" src="{{$viewData['registrationBatch']->retrieve()->barcode() }}">
                        </td>
                    </tr>
                </table>

                <p style="text-align: center;"><strong>Penyerahan BPKB ke Leasing {{$viewData['registrationBatch']['mainLeasing']['name']}}</strong></p>
                

                <table class="table" width="100%">
                    <tr>
                        <th>No BPKB</th>
                        <th>Plat Nomor</th>
                        <th>Nama Pemohon</th>
                        <th>Nama STNK</th>
                        <th>Alamat STNK</th>
                        <th>Tipe</th>
                        <th>Kode Tipe</th>
                        <th>Warna</th>
                        <th>Kode Warna</th>
                        <th>Nomor Rangka</th>
                        <th>Nomor Mesin</th>
                    </tr>
                    @foreach($viewData['registrationBatch']->getSalesOrders() as $salesOrder)
                    <tr>
                        <td>{{ $salesOrder->getAttribute('polReg.bpkb_number') }}</td>
                        <td>{{ $salesOrder->getAttribute('polReg.pol_reg') }}</td>
                        <td>{{ $salesOrder->getAttribute('customer.name') }}</td>
                        <td>{{ $salesOrder->getAttribute('registration.name') }}</td>
                        <td>{{ $salesOrder->getAttribute('registration.address') }}</td>
                        <td>{{ $salesOrder->unit->type_name }}</td>
                        <td>{{ $salesOrder->unit->type_code }}</td>
                        <td>{{ $salesOrder->unit->color_name }}</td>
                        <td>{{ $salesOrder->unit->color_code }}</td>
                        <td>{{ $salesOrder->unit->chasis_number }}</td>
                        <td>{{ $salesOrder->unit->engine_number }}</td>
                    </tr>
                    @endforeach
                </table><br>

                <p>Saya yang bertanda tangan dibawah ini perwakilan dari Leasing {{ $viewData['registrationBatch']['mainLeasing']['name'] }} menyatakan bahwa telah menerima BPKB dengan data motor-motor diatas.</p><br>

                <table class="table layout-table">
                    <tr>
                        <td style="width: 50%;">
                            <p>Karyawan Dealer</p>
                            <p style="padding-top: 4em;">{{ \ParsedJwt::getByKey('name') }}</p>
                        </td>
                        <td style="width: 50%;">
                            <p>Perwakilan Leasing</p>
                        </td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
    <!-- <script type="text/javascript">
    window.print()
</script> -->
</body>

</html>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

