<!DOCTYPE html>
<html>

<head>
    <title>SJ</title>
    <script type="text/javascript" src="/standard/jquery/jquery-2.2.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/standard/bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <style type="text/css">
    @media print {
        @page {
            size: A5 landscape;
            margin: 0.5cm;
        }
    }
    
    .container {
        font-family: 'Courier New' !important;
        font-size: 13px !important;
        letter-spacing: 1px !important;
    }
    
    p {
        margin: 0;
    }
    </style>
</head>

<body>
    <div id="printarea">
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
                        <div class="col-xs-4">
                            <p class="text-right"><strong>SURAT JALAN</strong></p>
                            <p class="text-right">{{ $viewData['salesOrder']->id }}</p>
                            <!-- <img style="max-height: 1em !important; width: auto; right: 0;" class="pull-right" src="{{ $viewData['salesOrder']->retrieve()->barcode() }}" class="img-responsive"> -->
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-4">
                            <p><strong>Kepada Yth,</strong></p>
                            <p>{{ $viewData['salesOrder']->getAttribute('customer.name') }}</p>
                            <p>{{ $viewData['salesOrder']->getAttribute('customer.address') }}</p>
                            <p>{{ $viewData['salesOrder']->getAttribute('customer.kecamatan') }}</p>
                            <p>{{ $viewData['salesOrder']->getAttribute('customer.kelurahan') }}</p>
                            <p>{{ $viewData['salesOrder']->getAttribute('customer.kode_pos') }}</p>
                            <p>{{ $viewData['salesOrder']->getAttribute('customer.phone_number') }}</p>
                        </div>
                        <div class="col-xs-4">
                            <p>Catatan Pengiriman:</p>
                            <p>{{ $viewData['salesOrder']->getAttribute('deliveryRequest.type') ? collect(config('gelora.delivery.types'))->where('code', $viewData['salesOrder']->getAttribute('deliveryRequest.type'))->first()['name'] : '' }}</p>
                            <p>Penerima:</p>
                            <p>{{ $viewData['salesOrder']->getAttribute('deliveryRequest.name') }}</p>
                            <p>{{ $viewData['salesOrder']->getAttribute('deliveryRequest.address') }}</p>
                            <p>{{ $viewData['salesOrder']->getAttribute('deliveryRequest.phone_number') }}</p>
                            <p>Catatan:</p>
                            <p>{{ $viewData['salesOrder']->getAttribute('deliveryRequest.request') }}</p>
                        </div>
                        <div class="col-xs-4">
                            <p>Tanggal SPK: {{$viewData['salesOrder']->validated_at->toDateString() }}</p>
                            <p>Tanggal Cetak SJ: {{ \Carbon\Carbon::now()->toDateTimeString() }}</p>
                            <p>Cetakan Ke: {{ $viewData['delivery']->delivery_note_generated_count }}</p>
                            @if($viewData['salesOrder']->payment_type=="credit")
                            <p>Leasing : {{$viewData['salesOrder']->getAttribute('leasingOrder.mainLeasing.name') }} ({{$viewData['salesOrder']->getAttribute('leasingOrder.subLeasing.name') }})</p>
                            @endif
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
    </div>
    <script type="text/javascript">
    window.print();
    </script>
</body>

</html>
