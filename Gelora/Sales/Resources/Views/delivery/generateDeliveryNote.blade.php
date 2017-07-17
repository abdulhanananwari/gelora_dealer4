@extends('layout.printing')

@section('title', 'SJ')

@section('content')

@component('components.header', ['viewData' => $viewData])
    @slot('title')
        Surat jalan
    @endslot
@endcomponent

<div class="row">
    <div class="col-xs-4">
        <p><strong>Kepada Yth,</strong></p>
        <p>{{ $viewData['salesOrder']->getAttribute('customer.name') }}</p>
        <p>{{ $viewData['salesOrder']->getAttribute('customer.address') }}</p>
        <p>{{ $viewData['salesOrder']->getAttribute('customer.kecamatan') }}</p>
        <p>{{ $viewData['salesOrder']->getAttribute('customer.kelurahan') }}</p>
        <p>{{ $viewData['salesOrder']->getAttribute('customer.kode_pos') }}</p>
        <p>{{ $viewData['salesOrder']->getAttribute('customer.phone_number') }}</p>
        </br>

        <p>Catatan Pengiriman: {{ $viewData['salesOrder']->getAttribute('deliveryRequest.type') ? collect(config('gelora.delivery.types'))->where('code', $viewData['salesOrder']->getAttribute('deliveryRequest.type'))->first()['name'] : '' }}</p>


    </div>
    <div class="col-xs-4">
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
<table border="1" width="100%">
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
</br>
<div class="row">
    <div class="col-xs-6">
        <table border="1" width="100%">
            <tr>
                <th>Hadiah</th>
            </tr>
            <tr>
                <td>
                    @foreach($viewData['salesOrder']->salesOrderExtras->where('item_code', 'Hadiah')->where('pending_handover', false)->all() as $extra)
                        <span>{{$extra->salesExtra['name']}}, </span>
                    @endforeach
                </td>
            </tr>
        </table>
    </div>
    <div class="col-xs-6">
        <table border="1" width="100%">
            <tr>
                <th>Kelengkapan</th>
            </tr>
            <tr>
                <td>
                    @foreach($viewData['salesOrder']->salesOrderExtras->where('item_code', 'Kelengkapan')->where('pending_handover', false)->all() as $extra)
                    <span>{{$extra->salesExtra['name']}}, </span> @endforeach
                </td>
            </tr>
        </table>
    </div>
</div>
</br>
<table border="1" width="100%" class="text-center">
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
<br>
<p style="text-align: justify;">Periksa Kondisi Kendaraan anda, cek no mesin di kendaraan dengan surat jalan. jika ada kelainan di kendaraan atau beda no mesin dikendaraan dengan surat jalan, jangan tanda tangani surat ini. Klaim setelah ditanda tangani surat ini tidak kami layani. Kecuali yang menyangkut ke garansi HONDA</p>
<br>

@endsection