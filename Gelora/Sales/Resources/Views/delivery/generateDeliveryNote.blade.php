<!DOCTYPE html>
<html>

<head>
    <title>SJ</title>
    <link rel="stylesheet" type="text/css" href="/standard/bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <style type="text/css">
    @media print {
        html,
        body {
            height: 100%;
            /*overflow: hidden;*/
            background: #FFF;
            font-size: 0.8em !important;
        }
    }
    
    .table {
        border-style: none !important;
        border: 0 !important;
    }
    
    p {
        margin: 0;
    }
    
    table > tr > td {
        vertical-align: top;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-xs-1">
                        <img style="width: auto; max-height: 5em !important;" class="img-responsive" src="{{ $viewData['tenantInfo']->LOGO }}">
                    </div>
                    <div class="col-xs-7">
                        <p><strong>{{ $viewData['tenantInfo']->TENANT }}</strong></p>
                        <p>{{ $viewData['tenantInfo']->ADDRESS }}</p>
                        <p>{{ $viewData['tenantInfo']->PHONE_NUMBER }}</p>
                    </div>
                    <div class="col-xs-4 text-right pull-right">
                        <p><strong>SURAT JALAN</strong> {{ $viewData['salesOrder']->id }}</p>
                        <img style="max-height: 50%;" class="pull-right" src="{{ $viewData['salesOrder']->retrieve()->barcode() }}" class="img-responsive">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-6">
                        <p>Kepada,</p>
                        <p>{{ $viewData['salesOrder']->customer['name'] }}</p>
                        <p>{{ $viewData['salesOrder']->customer['address'] }}</p>
                        <p>{{ $viewData['salesOrder']->customer['kecamatan'] }}</p>
                        <p>{{ $viewData['salesOrder']->customer['kelurahan'] }}</p>
                        <p>{{ $viewData['salesOrder']->customer['kode_pos'] }}</p>
                        <p>{{ $viewData['salesOrder']->customer['phone_number'] }}</p>
                        @if($viewData['salesOrder']->payment_type=="credit")
                            <p>Leasing : {{$viewData['salesOrder']->leasingOrder['mainLeasing']['name']}}</p>
                        @endif
                    </div>
                    <div class="col-xs-6">
                        <p>Tanggal SPK: {{$viewData['salesOrder']->validated_at->toDateString() }}</p>
                        <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->toDateTimeString() }}</p>
                        <p>Cetakan Ke: {{ $viewData['delivery']->delivery_note_generated_count }}</p>
                    </div>
                </div>
                <br>
                <table border="1" class="table">
                    <tr>
                        <th>Merk</th>
                        <th>Type</th>
                        <th>Warna</th>
                        <th>No Rangka</th>
                        <th>No Mesin</th>
                    </tr>
                    <tr>
                        <td>{{$viewData['unit']->brand }}</td>
                        <td>{{$viewData['unit']->type_name}} ({{ $viewData['unit']->type_code }})</td>
                        <td>{{$viewData['unit']->color_name}}</td>
                        <td>{{$viewData['unit']->chasis_number}}</td>
                        <td>{{$viewData['unit']->engine_number}}</td>
                    </tr>
                </table>
                <div class="row">
                    <div class="col-xs-6">
                        <table border="1" class="table">
                            <tr>
                                <th>Hadiah</th>
                            </tr>
                            @foreach($viewData['salesOrder']->salesOrderExtras->where('item_code', 'Hadiah')->all() as $extra)
                            <tr>
                                <td>{{$extra->salesExtra['name']}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="col-xs-6">
                        <table border="1" class="table">
                            <tr>
                                <th>Kelengkapan</th>
                            </tr>
                            @foreach($viewData['salesOrder']->salesOrderExtras->where('item_code', 'Kelengkapan')->all() as $extra)
                            <tr>
                                <td>{{$extra->salesExtra['name']}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <table border="1" class="table text-center">
                    <tr>
                        <td>
                            <p>Dibuat Oleh</p>
                            <br>
                            <br>
                            <p>{{$viewData['jwt']->name}}</p>
                        </td>
                        <td>
                            <p>Supir</p>
                            <br>
                            <br>
                            <p>{{ $viewData['delivery']->get('driver.name') }}</p>
                        </td>
                        <td style="vertical-align: text-bottom;">
                            <p>Disetujui Oleh</p>
                        </td>
                        <td style="vertical-align: text-bottom;">
                            <p>Pembeli/Penerima</p>
                        </td>
                    </tr>
                </table>
                <p style="text-align: justify;">Periksa Kondisi Kendaraan anda, cek no mesin di kendaraan dengan surat jalan. jika ada kelainan di kendaraan atau beda no mesin dikendaraan dengan surat jalan, jangan tanda tangani surat ini. Klaim setelah ditanda tangani surat ini tidak kami layani. Kecuali yang menyangkut ke garansi HONDA</p>
                <br>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    window.print()
    </script>
</body>

</html>
