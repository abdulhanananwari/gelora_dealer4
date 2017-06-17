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
                    <p><strong>BUKTI TERIMA KENDARAAN</strong></p>
                    <P>No SPK : {{ $viewData['salesOrder']->id }} </P>

                    <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->toDateTimeString() }}</p>
                </td>
            </tr>		
        </table>

        <table class="table">
            <tr>
                <td>
                    <p>Kepada,</p>
                    <p>{{ $viewData['salesOrder']->customer['name'] }}</p>
                    <p>{{ $viewData['salesOrder']->customer['address'] }}</p>
                    <p>{{ $viewData['salesOrder']->customer['phone_number'] }}</p>
                </td>
               
              <!--   <td style="float: right;">
                    <p>Delivery Request</p>
                    <p>{{ $viewData['salesOrder']->delivery_rerquest['name'] }}</p>
                    <p>{{ $viewData['salesOrder']->delivery_rerquest['phone_number'] }}</p>
                    <p>{{ $viewData['salesOrder']->delivery_rerquest['address'] }}</p>
                    <p>{{ $viewData['salesOrder']->delivery_rerquest['type'] }}</p>
                    <p>{{ $viewData['salesOrder']->delivery_rerquest['request'] }}</p>
                </td>
                 -->
                <td>
                    <p>No Spk: {{ $viewData['salesOrder']->id }} </p>
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
                @if(isset($viewData['deliveryBatch']))
                <td>
                    <p>Delivery Batch</p>
                    <br><br>
                    <p>{{$viewData['deliveryBatch']->driver_name}}</p>
                </td>
                @endif
                <td style="vertical-align: text-bottom;">
                    <p>Disetujui Oleh</p>
                </td>
                <td style="vertical-align: text-bottom;">
                    <p>Pembeli/Penerima</p>
                </td>
            </tr>
        </table>

        <p style="text-align: justify;">Periksa Kondisi Kendaraan anda , cek no mesin di kendaraan dengan surat jalan, jika ada kelainan di kendaraan atau beda no mesin dikendaraan dengan surat jalan, jangan tanda tangani surat ini. klaim setelah ditanda tangani surat ini tidak kami layani, Kecuali yang menyangkut ke garansi HONDA</p>

        <script type="text/javascript">
            window.print()
        </script>
    </body>
</html>