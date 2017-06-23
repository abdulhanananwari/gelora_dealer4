<!DOCTYPE html>
<html>

<head>
    <title>Bukti Tagihan Leasing #{{$viewData['salesOrder']}}</title>
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
                <table class="table layout-table" style="width :  100%; margin-bottom: 5px;">
                    <tr>
                        <td style="width :  8em; padding-right :  10px;">
                            <img style="width: auto; max-height: 5em !important;" class="img-responsive" src="{{ $viewData['tenantInfo']->LOGO }}">
                        </td>
                        <td>
                            <p><strong>{{ $viewData['tenantInfo']->TENANT }}</strong></p>
                            <p>{{ $viewData['tenantInfo']->ADDRESS }}</p>
                            <p>{{ $viewData['tenantInfo']->PHONE_NUMBER }}</p>
                        </td>
                        <td>
                            <p class="text-right">INVOICE LEASING {{$viewData['salesOrder']->id}}</p>
                            <img style="height: auto; max-width: 20em !important;" class="img-responsive pull-right" src="{{ $viewData['salesOrder']->retrieve()->barcode() }}">
                        </td>
                    </tr>
                </table>
                <table class="table" width="100%">
                    <tr>
                        <td width="50%">
                            <table id="content">
                                <tr>
                                    <td>Telah terima dari</td>
                                    <td style="padding-left:5px;padding-right:5px;">:</td>
                                    <td>{{ $viewData['leasingOrder']->mainLeasing['name'] }}</td>
                                </tr>
                                <tr>
                                    <td>Untuk</td>
                                    <td style="padding-left:5px;padding-right:5px;">:</td>
                                    <td>{{ $viewData['leasingOrder']->vehicle['name']}}</td>
                                </tr>
                                <tr>
                                    <td>No Rangka</td>
                                    <td style="padding-left:5px;padding-right:5px;">:</td>
                                    <td>{{$viewData['unit']->chasis_number}}</td>
                                </tr>
                                <tr>
                                    <td>No Mesin</td>
                                    <td style="padding-left:5px;padding-right:5px;">:</td>
                                    <td>{{$viewData['unit']->engine_number}}</td>
                                </tr>
                            </table>
                            <br>
                            <table id="content">
                                <tr>
                                    <td>On The Road</td>
                                    <td style="padding-left:5px;padding-right:75px;"></td>
                                    <td>{{number_format($viewData['leasingOrder']->on_the_road)}}</td>
                                </tr>
                                <tr>
                                    <td>Tanda Jadi</td>
                                    <td style="padding-left:5px;padding-right:75px;"></td>
                                    <td style="text-align: right;">{{ number_format($viewData['leasingOrder']->dp_po) }}</td>
                                </tr>
                                <tr>
                                    <td style="padding-top: 10px;">Pelunasan</td>
                                    <td style="padding-left:5px;padding-right:75px;"></td>
                                    <td style="padding-top: 10px;">{{ number_format($viewData['leasingOrder']->leasing_payable) }}</td>
                                </tr>
                            </table>
                            <br>
                            <table>
                                <tr>
                                </tr>
                                <tr style="height: 8em;">
                                    <td>{{$viewData['jwt']->name}}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
