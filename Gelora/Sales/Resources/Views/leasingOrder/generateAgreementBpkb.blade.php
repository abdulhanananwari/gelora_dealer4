<!DOCTYPE html>
<html>

<head>
    <title>Surat Pernyataan Dan Kuasa #{{$viewData['salesOrder']}}</title>
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
                            <p class="text-right">{{$viewData['leasingOrder']->id}}</p>
                            <img style="height: auto; max-width: 20em !important;" class="img-responsive pull-right" src="{{ $viewData['salesOrder']->retrieve()->barcode() }}">
                        </td>
                    </tr>
                </table>
                <table class="table" width="100%">
                    <tr>
                        <td width="50%">
                            <p style="text-align: center;">SURAT PERNYATAAN DAN KUASA</p>
                            <p>Saya yang bertanda tangan dibawah ini : </p>
                            <table id="content">
                                <tr>
                                    <td style="padding-left:25px;">Nama</td>
                                    <td style="padding-left:90px;padding-right:5px;">:</td>
                                    <td>{{$viewData['settingAgreementBpkb']->from['NAME']}}</td>
                                </tr>
                                <tr>
                                    <td style="padding-left:25px;">Jabatan</td>
                                    <td style="padding-left:90px;padding-right:5px;">:</td>
                                    <td>{{$viewData['settingAgreementBpkb']->from['POSITION']}}</td>
                                </tr>
                                <tr>
                                    <td style="padding-left:25px;">Alamat</td>
                                    <td style="padding-left:90px;padding-right:5px;">:</td>
                                    <td>{{$viewData['settingAgreementBpkb']->from['ADDRESS']}}</td>
                                </tr>
                                <tr>
                                    <td style="padding-left:25px;">Telp</td>
                                    <td style="padding-left:90px;padding-right:5px;">:</td>
                                    <td>{{$viewData['settingAgreementBpkb']->from['PHONE_NUMBER']}}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                            <p>Dengan ini menyatakan bahwa surat-surat BPKB dan Faktur dibawah ini</p>
                            <table id="content">
                                <tr>
                                    <td style="padding-left:25px;">Nama Konsumen</td>
                                    <td style="padding-left:25px;padding-right: 5px;">:</td>
                                    <td>{{$viewData['leasingOrder']->customer['name']}}</td>
                                </tr>
                                <tr>
                                    <td style="padding-left:25px;vertical-align: text-bottom;">Alamat</td>
                                    <td style="padding-left:25px;padding-right: 5px; vertical-align: text-bottom;">:</td>
                                    <td style="width: 4em;height: 25px;">{{$viewData['leasingOrder']->customer['address']}}</td>
                                </tr>
                                <tr>
                                    <td style="padding-left:25px;">Merk</td>
                                    <td style="padding-left:25px;padding-right: 5px;">:</td>
                                    <td>{{$viewData['salesOrder']->unit->brand}}</td>
                                </tr>
                                <tr>
                                    <td style="padding-left:25px;">Jenis Kendaraan</td>
                                    <td style="padding-left:25px;padding-right: 5px;">:</td>
                                    <td>{{$viewData['salesOrder']->unit->type_name}}</td>
                                </tr>
                                <tr>
                                    <td style="padding-left:25px;">Tahun Pembuatan</td>
                                    <td style="padding-left:25px;padding-right: 5px;">:</td>
                                    <td>{{$viewData['salesOrder']->unit->assembly_year}}</td>
                                </tr>
                                <tr>
                                    <td style="padding-left:25px;">No Rangka</td>
                                    <td style="padding-left:25px;padding-right: 5px;">:</td>
                                    <td>{{$viewData['salesOrder']->unit->chasis_number}}</td>
                                </tr>
                                <tr>
                                    <td style="padding-left:25px;">No Mesin</td>
                                    <td style="padding-left:25px;padding-right: 5px;">:</td>
                                    <td>{{$viewData['salesOrder']->unit->engine_number}}</td>
                                </tr>
                                <tr>
                                    <td style="padding-left:25px;">Warna</td>
                                    <td style="padding-left:25px;padding-right: 5px;">:</td>
                                    <td>{{$viewData['salesOrder']->unit->color_name}}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <table width="100%">
                    <tr>
                        <td>
                            <?php
                        $content = $viewData['settingAgreementBpkb']->content;
                        $content = str_replace('**LEASING_NAME**', $viewData['leasing']['name'], $content);
                        $content = str_replace('**LEASING_ADDRESS**', $viewData['leasing']['address'], $content);
                    ?>
                                <p>{{ $content }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Yang Menyatakan</p>
                            <p style="padding-top: 35px;">{{$viewData['jwt']->name}}</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    window.print()
    </script>
</body>

</html>
