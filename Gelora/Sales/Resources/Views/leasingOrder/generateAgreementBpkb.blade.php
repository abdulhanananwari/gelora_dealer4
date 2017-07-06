<!DOCTYPE html>
<html>

<head>
    <title>Surat Pernyataan Dan Kuasa #{{$viewData['salesOrder']}}</title>
    <link rel="stylesheet" type="text/css" href="/standard/bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <style type="text/css">
    @media print {
        html,
        body {
            height: 100%;
            background: #FFF;
            font-size: 0.8em !important;
        }
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
                        <p>{{ $viewData['salesOrder']->id }}</p>
                        <img style="max-height: 50%;" class="pull-right" src="{{ $viewData['salesOrder']->retrieve()->barcode() }}" class="img-responsive">
                    </div>
                </div>
                <hr>
                <p class="text-center"><strong>SURAT PERNYATAAN DAN KUASA</strong></p>
                <br>
                <p>Saya yang bertanda tangan dibawah ini : </p>
                <table width="100%">
                    <tbody>
                        <tr>
                            <td style="width: 20%">Nama</td>
                            <td style="width: 5%">:</td>
                            <td style="width: 50%">{{$viewData['settingAgreementBpkb']->from['NAME']}}</td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>:</td>
                            <td>{{$viewData['settingAgreementBpkb']->from['POSITION']}}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{$viewData['settingAgreementBpkb']->from['ADDRESS']}}</td>
                        </tr>
                        <tr>
                            <td>Telp</td>
                            <td>:</td>
                            <td>{{$viewData['settingAgreementBpkb']->from['PHONE_NUMBER']}}</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <p>Dengan ini menyatakan bahwa surat-surat BPKB dan Faktur dibawah ini:</p>
                <table width="100%">
                    <tbody>
                        <tr>
                            <td style="width: 20%">Nama Konsumen</td>
                            <td style="width: 5%">:</td>
                            <td style="width: 50%">{{$viewData['leasingOrder']->customer['name']}}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ $viewData['leasingOrder']->customer['address'] }}</td>
                        </tr>
                        <tr>
                            <td>Merk</td>
                            <td>:</td>
                            <td>{{$viewData['salesOrder']->unit->brand}}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kendaraan</td>
                            <td>:</td>
                            <td>{{$viewData['salesOrder']->unit->type_name}}</td>
                        </tr>
                        <tr>
                            <td>Tahun Pembuatan</td>
                            <td>:</td>
                            <td>{{$viewData['salesOrder']->unit->assembly_year}}</td>
                        </tr>
                        <tr>
                            <td>No Rangka</td>
                            <td>:</td>
                            <td>{{$viewData['salesOrder']->unit->chasis_number}}</td>
                        </tr>
                        <tr>
                            <td>No Mesin</td>
                            <td>:</td>
                            <td>{{$viewData['salesOrder']->unit->engine_number}}</td>
                        </tr>
                        <tr>
                            <td>Warna</td>
                            <td>:</td>
                            <td>{{$viewData['salesOrder']->unit->color_name}}</td>
                        </tr>
                    </tbody>
                </table>
                <?php
                    $content = $viewData['settingAgreementBpkb']->content;
                    $content = str_replace('**LEASING_NAME**', $viewData['leasing']['name'], $content);
                    $content = str_replace('**LEASING_ADDRESS**', $viewData['leasing']['address'], $content);
                ?>
                    <br>
                    <p>{{ $content }}</p>
                    <br>
                    <p>Yang Menyatakan</p>
                    <br>
                    <br>
                    <br>
                    <p>{{$viewData['jwt']->name}}</p>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    // window.print()
    </script>
</body>

</html>
