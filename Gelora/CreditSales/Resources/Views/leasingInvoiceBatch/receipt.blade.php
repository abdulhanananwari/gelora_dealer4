@extends('layout.printing')

@section('title', 'Batch Tagihan Leasing')

@section('content')

@component('components.batchHeader', ['viewData' => $viewData ])
    @slot('title')
        Tagihan Leasing
    @endslot
    @slot('batchID')
        {{ $viewData['leasingInvoiceBatch']->id }}
    @endslot
@endcomponent

<div class="row">
    <div class="col-xs-6">
        <h4>Tanda Terima Tagihan Leasing</h4>
    </div>
    <div class="col-xs-6">
        <p>Pusat: {{ $viewData['leasingInvoiceBatch']->getAttribute('mainLeasing.name') }}</p>
        <p>Cabang: {{ $viewData['leasingInvoiceBatch']->getAttribute('subLeasing.name') }}</p>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <table class="table" border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tipe</th>
                    <th>No Mesin</th>
                    <th>No Aplikasi</th>
                    <th>No PO</th>
                    <th>Tenor</th>
                    <th>DP</th>
                    <th>Memo Leasing</th>
                </tr>
            </thead>
            <tbody>
                <?php $number = 0 ?>
                @foreach($viewData['leasingInvoiceBatch']->getSalesOrders() as $salesOrder)
                <?php $number++ ?>
                <tr>
                    <td>{{ $number }}</td>
                    <td>{{ $salesOrder->getAttribute('registration.name') }}</td>
                    <td>{{ $salesOrder->getAttribute('delivery.unit.type_name') }}</td>
                    <td>{{ $salesOrder->getAttribute('delivery.unit.engine_number') }}</td>
                    <td>{{ $salesOrder->getAttribute('leasingOrder.application_number') }}</td>
                    <td>{{ $salesOrder->getAttribute('leasingOrder.po_number') }}</td>
                    <td>{{ $salesOrder->getAttribute('leasingOrder.tenor') }}</td>
                    <td>{{ number_format($salesOrder->getAttribute('leasingOrder.dp_po')) }}</td>
                    <td>{{ $salesOrder->getAttribute('leasingOrder.note') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        Bandung, {{ \Carbon\Carbon::now()->toDateString() }}
    </div>
</div>

<div class="row">
    <div class="col-xs-4">
        <p>Yang Menyerahkan,</p>
        <br><br><br>
        <p>{{ \ParsedJwt::getByKey('name') }}</p>
    </div>
    <div class="col-xs-4">
        <p>Yang Menerima,</p>
        <br><br><br>
    </div>
</div>

@endsection