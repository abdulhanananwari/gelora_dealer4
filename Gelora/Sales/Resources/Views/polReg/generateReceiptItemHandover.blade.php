<!DOCTYPE html>
<html>
<head>
	<title>Bukti penyerahan barang</title>
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
                        <p style="float: right;padding-right: 55px;">No SPK : {{$viewData['salesOrder']->id}}</p>
                        <img style="width: auto; max-height: 4em !important; float: right;" class="img-responsive" src="{{$viewData['salesOrder']->retrieve()->barcode() }}">
                    </td>
                </tr>       
            </table>
            <table class="table" width="100%">
                <tr>
                    <td width="50%">
                        <p style="text-align: center;"><strong>Penyerahan {{$viewData['outgoing']['name']}} </strong></p>
                        <table id="content">
                            <tr>
                                <td>Telah Terima Dari</td>
                                <td style="padding-left:5px;padding-right:5px;">:</td>
                                <td>{{$viewData['tenantInfo']->TENANT }}</td>           
                            </tr>
                            <tr>
                                <td>Nama Barang</td>
                                <td style="padding-left:5px;padding-right:5px;">:</td>
                                <td><p><strong>{{$viewData['outgoing']['name']}}</strong></p></td>
                            </tr>
                            <tr>
                                <td>Tanggal Terima</td>
                                <td style="padding-left:5px;padding-right:5px;">:</td>
                                <td>{{ \Carbon\Carbon::createFromTimestamp($viewData['outgoing']['creator']['timestamp'])->toDateTimeString() }}</td>
                            </tr>
                            <tr>
                                <td>Penerima</td>
                                <td style="padding-left:5px;padding-right:5px;">:</td>
                                <td>{{ isset($viewData['outgoing']['receiver_name']) ? $viewData['outgoing']['receiver_name'] : '' }}</td>
                            </tr>
                            <tr>
                                <td>Nomor Ktp</td>
                                <td style="padding-left:5px;padding-right:5px;">:</td>
                                <td>{{ isset($viewData['outgoing']['receiver_id']) ? $viewData['outgoing']['receiver_id'] : '' }}</td>
                            </tr>
                            <tr>
                                <td>Catatan</td>
                                <td style="padding-left:5px;padding-right:5px;">:</td>
                                <td>{{ isset($viewData['outgoing']['note']) ? $viewData['outgoing']['note'] : '' }}</td>
                            </tr>
                        </table>
                    </td>
                    <td width="50%">
                        <p style="text-align: center;"><strong>Penyerahan {{$viewData['outgoing']['name']}} </strong></p>
                        <table id="content">
                                <td>Tanggal Cetak</td>
                                <td style="padding-left:5px;padding-right:5px;">:</td>
                                <td>{{ \Carbon\Carbon::now('Asia/Jakarta')->toDateTimeString() }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>                
            </table>
           <table class="table" >
                <tr>
                    <td>
                        <p>Dibuat Oleh</p>
                        <p style="padding-top: 3em;">{{$viewData['outgoing']['creator']['name']}}</p>
                    </td>
                    <td>
                        <p>Diterima Oleh</p>
                        <p style="padding-top: 3em;">{{$viewData['outgoing']['receiver_name']}}</p>
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