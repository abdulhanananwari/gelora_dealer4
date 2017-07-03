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
                <table class="table">
                    <tr>
                        <td style="width: 50%;">
                            <p>Kepada,</p>
                            <p>{{ $viewData['salesOrder']->customer['name'] }}</p>
                            <p>{{ $viewData['salesOrder']->customer['address'] }}</p>
                            <p>{{ $viewData['salesOrder']->customer['phone_number'] }}</p>
                        </td>
                        <td style="width: 50%;">
                            <p>Tanggal SPK: {{$viewData['salesOrder']->validated_at->toDateString() }}</p>
                            <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->toDateTimeString() }}</p>
                        </td>
                    </tr>
                </table>
                <table class="table">
                    <tr>
                        <td style="width: 100%;">
                            <p></p>

                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
