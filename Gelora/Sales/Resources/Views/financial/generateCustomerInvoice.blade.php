<!DOCTYPE html>
<html>

<head>
    <title>Tagihan Customer #{{ $viewData['salesOrder']->id }}</title>
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
                            <p class="text-right">Tagihan SPK {{ $viewData['salesOrder']->id }}</p>
                            <img style="height: auto; max-width: 20em !important;" class="img-responsive pull-right" src="{{ $viewData['salesOrder']->retrieve()->barcode() }}">
                        </td>
                    </tr>
                </table>
                <h2 class="text-center">INVOICE / TAGIHAN</h2>
                <hr>
                <table style="width: 100%">
                    <tr>
                        <td style="width: 70%;">
                            <table>
                                <tr>
                                    <td style="width: 50%;">Nama customer</td>
                                    <td style="width: 50%; padding-left: 5px;">{{ $viewData['salesOrder']->customer['name'] }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 1.2em;">Total Terhutang</td>
                                    <td style="padding-left: 5px;"><strong>Rp {{ number_format($viewData['balance']['payment_unreceived']) }}</strong></td>
                                </tr>
                                <tr>
                                    <td style="font-size: 1.2em;">Total Tagihan Ini</td>
                                    <td style="padding-left: 5px;"><strong>Rp {{ number_format($viewData['invoiceAmount'])}}</strong></td>
                                </tr>
                                
                                <tr>
                                    <td>Untuk</td>
                                    <td style="padding-left: 5px;">Pelunasan SPK {{ $viewData['salesOrder']->id }}</td>
                                </tr>
                            </table>
                        </td>
                        <td style="width: 30%;" valign="top">
                            <p>Tanggal SPK: {{$viewData['salesOrder']->created_at->toDateTimeString() }}</p>
                            @if( $viewData['salesOrder']->validated_at )
                                <p>Tanggal Validasi: {{$viewData['salesOrder']->validated_at->toDateTimeString() }}</p>
                            @endif
                            <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->toDateTimeString() }}</p>
                        </td>
                    </tr>
                </table>
                <br>
                <p><strong>Petunjuk Pembayaran:</strong></p>
                <ul>         
                    <li>Pembayaran menggunakan transfer bank harap dilakukan ke rekening <strong>{{ $viewData['tenantInfo']->BANK }}</strong> nomor account <strong>{{ $viewData['tenantInfo']->BANK_ACCOUNT_NUMBER }}</strong> atas nama <strong>{{ $viewData['tenantInfo']->BANK_ACCOUNT_NAME }}</strong> dengan mencantumkan keterangan: <strong>PEL SPK {{ substr($viewData['salesOrder']->id, -5) }}</strong></li>
                </ul>
                <br>
                <table style="width: 100%;" class="table-bordered">
                    <tr style="height: 100px;" class="text-center">
                        <td style="width: 25%;" valign="top">
                            <p >Pembuat</p>
                        </td>
                        <td style="width: 25%;" valign="top">
                            <p >Mengetahui</p>
                        </td>
                        <td style="width: 25%;" valign="top">
                            <p >Yang Menerima</p>
                        </td>
                        <td style="width: 25%;" valign="top">
                            <p >Konsumen</p>
                        </td>
                    </tr>
                    <tr class="text-center">
                        <td>
                            <p>{{ $viewData['jwt']->name }}</p>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
