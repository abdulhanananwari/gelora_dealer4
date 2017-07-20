@extends('layout.printing')

@section('title', 'SJ')

@section('content')

@component('components.header', ['viewData' => $viewData])
    @slot('title')
        Serah Terima Side Order
    @endslot
@endcomponent
<br>
<div class="row">
    <div class="col-xs-12">
        <p><strong>Sehubungan dengan pembelian sepeda motor sebagai berikut:</strong></p>
        <p>Type: {{ $viewData['salesOrder']->getAttribute('delivery.unit.type_name') }}</p>
        <p>Warna: {{ $viewData['salesOrder']->getAttribute('delivery.unit.color_name') }}</p>
        <p>Nomor Mesin: {{ $viewData['salesOrder']->getAttribute('delivery.unit.engine_number') }}</p>
        <p>Nomor Chasis: {{ $viewData['salesOrder']->getAttribute('delivery.unit.chasis_number') }}</p>
        <p>Nama Pembeli: {{ $viewData['salesOrder']->getAttribute('customer.name') }}</p>
        <p>Tgl SJ: {{ $viewData['salesOrder']->getAttribute('delivery.generated_at')->toDateString() }}</p>
        </br><br>
        <p>Yang bertanda tangan dibawah ini <strong>{{ $viewData['salesOrderExtra']->getAttribute('handover.receiver_name') }}</strong>, menyatakan telah menerima <strong>{{ $viewData['salesOrderExtra']->item_name }}</strong> pada {{ \Carbon\Carbon::now()->toDateTimeString() }} </p>
    </div>
</div>
</br>
</br>
<div class="row">
    <div class="col-xs-6">
        <p>Penerima</p>
        </br>
        </br>
        </br>
    </p>{{ $viewData['salesOrderExtra']->getAttribute('handover.receiver_name') }}</p>
    </div>
    <div class="col-xs-6">
        <p>Yang menyerahkan</p>
        </br>
        </br>
        </br>
    </p>{{ \ParsedJwt::getByKey('name') }}</p>
    </div>
</div>

@endsection