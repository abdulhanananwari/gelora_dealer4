<!DOCTYPE html>
<html>
    <head>
        <title>SJ</title>

        <link rel="stylesheet" type="text/css" href="/standard/bootstrap-3.3.6-dist/css/bootstrap.min.css">

        <style type="text/css">

            @media print {
                html, body {
                    height:100%; 
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

        <table class="table">
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
                    <p><strong>SURAT JALAN</strong></p>
                    <img style="max-height: 50%;" src="{{ $viewData['salesOrder']->retrieve()->barcode() }}" class="img-responsive">
                    <P>{{ $viewData['salesOrder']->id }} </p>
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
                    @if(isset($viewData['salesOrder']->leasingOrder))
                        <p style="margin-top: 10px;">Leasing : {{$viewData['salesOrder']->leasingOrder['mainLeasing']['name']}}</p>
                    @endif
                </td>
                <td style="width: 50%;">
                    <p>Tanggal SPK: {{$viewData['salesOrder']->validated_at->toDateString() }}</p>
                    <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->toDateTimeString() }}</p>
                    <p>Cetakan Ke: {{ $viewData['delivery']->delivery_note_generated_count }}</p>
                </td>
            </tr>
        </table>
        <br>
        <table class="table">
            <tr>
                <td>Merk</td>
                <td>Type</td>
                <td>Warna</td>
                <td>No Rangka</td>
                <td>No Mesin</td>
            </tr>
            <tr>
                <td>{{$viewData['unit']->brand }}</td>
                <td>{{$viewData['unit']->type_name}} ({{ $viewData['unit']->type_code }})</td>
                <td>{{$viewData['unit']->color_name}}</td>
                <td>{{$viewData['unit']->chasis_number}}</td>
                <td>{{$viewData['unit']->engine_number}}</td>
            </tr>
        </table>
        <!--kelengkapan dan hadiah belum  dikerjakan  -->
        
        <table border="1" class="table text-center">
            <tr>
                <td>
                    <p>Dibuat Oleh</p>
                    <br><br>
                    <p>{{$viewData['jwt']->name}}</p>
                </td>
                <td>
                    <p>Supir</p>
                    <br><br>
                    <p>{{$viewData['salesOrder']->delivery['driver_name']}}</p>
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

        <script type="text/javascript">
            window.print()
        </script>
    </body>
</html>