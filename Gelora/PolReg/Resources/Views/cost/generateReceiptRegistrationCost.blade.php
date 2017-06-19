<!DOCTYPE html>
<html>
<head>
	<title>Bukti pembayaran </title>
	<link rel="stylesheet" type="text/css" href="/standard/bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <style type="text/css">

         .table {
            border-style :  none !important;
            border :  0 !important;
        }
         .layout-table > tbody > tr > td {
            border-top :  0px !important;
            vertical-align :  top;
        }

        p {
            margin :  0;
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
                        <p class="text-right">No Faktur : {{$viewData['registration']->id}}</p>
                        <img style="width: auto; max-height: 3em !important; float: right; padding-right: 0px;" class="img-responsive" src="{{$viewData['registration']->generateBarcode() }}">
                    </td>
                </tr>       
            </table>
            <table class="table" width="100%">
                <tr>
                    <td width="50%">
                        <p style="text-align: center;"><strong>Penagihan {{ $viewData['cost']['name'] }}</strong></p>
                        <table id="content">
                            @if(isset($viewData['cost']['payer_name']))
                            <tr>
                                <td>Telah Terima Dari</td>
                                <td style="padding-left:5px;padding-right:5px;">:</td>
                                <td>{{$viewData['cost']['payer_name']}}</td>
                            </tr>
                            @endif
                            <tr>
                                <td>Jumlah</td>
                                <td style="padding-left:5px;padding-right:5px;">:</td>
                                <td><p><strong> Rp {{number_format($viewData['cost']['amount_to_charge_to_customer'])}}</strong></p></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td style="padding-left:5px;padding-right:5px;">:</td>
                                <td>{{\Carbon\Carbon::now('Asia/Jakarta')->format('d-m-Y')}}</td>
                            </tr>
                            <tr>
                                <td>Untuk Pembayaran</td>
                                <td style="padding-left:5px;padding-right:5px;">:</td>
                                <td><p><strong>{{$viewData['cost']['name']}}</strong></p></td>
                            </tr>
                            <tr>
                                <td>Cetakan Ke</td>
                                <td style="padding-left:5px;padding-right:5px;">:</td>
                                <td><p>{{$viewData['cost']['printed_count']}}</p></td>
                            </tr>
                            <tr>
                                <td>SOE ID</td>
                                <td style="padding-left:5px;padding-right:5px;">:</td>
                                <td><p>{{$viewData['cost']['sales_order_extra_id']}}</p></td>
                            </tr>
                        </table>
                    </td>
                </tr>                
            </table>
            <table class="table" >
                <tr>
                    <td>
                        <p>Dibuat Oleh</p>
                        <p style="padding-top: 3em;">{{$viewData['cost']['user']['name']}}</p>
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