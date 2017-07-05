<!DOCTYPE html>
<html>

<head>
    <title>Bukti penyerahan barang</title>
    <link rel="stylesheet" type="text/css" href="/standard/bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <style type="text/css">
    @media print {
        @page {
            size: a5 landscape
        }
    }
    
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
                            <p style="float: right;padding-right: 55px;">No SPK : {{$viewData['salesOrder']->id}}</p>
                            <img style="width: auto; max-height: 4em !important; float: right;" class="img-responsive" src="{{$viewData['salesOrder']->retrieve()->barcode() }}">
                        </td>
                    </tr>
                </table>
                <hr>
                <h4 style="text-align: center;"><strong>Tanda Terima {{$viewData['item']['name']}} </strong></h4>
                <table class="table layout-table" width="100%" style="border: none">
                    <tr>
                        <td width="50%">
                            <table id="content">
                                <tr>
                                    <td width="40%">Telah Terima Dari</td>
                                    <td width="10%">:</td>
                                    <td width="40%">{{$viewData['tenantInfo']->TENANT }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Barang</td>
                                    <td>:</td>
                                    <td>
                                        <p><strong>{{$viewData['item']['name']}}</strong></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Penerima</td>
                                    <td>:</td>
                                    <td>{{ isset($viewData['outgoing']['receiver_name']) ? $viewData['outgoing']['receiver_name'] : '' }}</td>
                                </tr>
                                <tr>
                                    <td>Nomor KTP</td>
                                    <td>:</td>
                                    <td>{{ isset($viewData['outgoing']['receiver_id']) ? $viewData['outgoing']['receiver_id'] : '' }}</td>
                                </tr>
                                <tr>
                                    <td>Catatan</td>
                                    <td>:</td>
                                    <td>{{ isset($viewData['outgoing']['note']) ? $viewData['outgoing']['note'] : '' }}</td>
                                </tr>
                            </table>
                        </td>
                        <td width="50%">
                            <table id="content">
                                <tr>
                                    <td width="40%">Tanggal Cetak</td>
                                    <td width="10%">:</td>
                                    <td width="40%">{{ \Carbon\Carbon::now('Asia/Jakarta')->toDateTimeString() }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Serah Terima</td>
                                    <td>:</td>
                                    <td>{{ \Carbon\Carbon::createFromTimestamp($viewData['outgoing']['creator']['timestamp'])->toDateTimeString() }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <table class="table">
                    <tr>
                        <td>
                            <p>Dibuat Oleh</p>
                            <p style="padding-top: 5em;">{{$viewData['outgoing']['creator']['name']}}</p>
                        </td>
                        <td>
                            <p>Diterima Oleh</p>
                            <p style="padding-top: 5em;">{{$viewData['outgoing']['receiver_name']}}</p>
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
