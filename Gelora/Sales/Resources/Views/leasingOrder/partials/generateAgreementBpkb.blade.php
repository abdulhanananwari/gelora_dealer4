@component('components.headerMini', ['viewData' => $viewData])
    @slot('title')
        Surat Pernyataan Dan Kuasa    
    @endslot
@endcomponent

<div class="row">
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