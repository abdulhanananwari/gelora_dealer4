@extends('layout.printing')

@section('title', 'Batch Tagihan Leasing')

@section('content')

@component('components.batchHeader', ['viewData' => $viewData ])
    @slot('title')
        Tagihan Leasing
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
                    <th class="col-xs-1">No</th>
                    <th>Nama</th>
                    <th>Tipe</th>
                    <th>No Mesin</th>
                    <th>No Rangka</th>
                    <th>No Aplikasi</th>
                    <th>No PO</th>
                    <th>Tenor</th>
                    <th>DP</th>
                </tr>
            </thead>
            <tbody>
                @foreach($viewData['leasingInvoiceBatch']->getSalesOrders() as $salesOrder)
                <tr>
                    <td>{{ $salesOrder->getAttribute('customer.name') }}</td>
                    <td>{{ $salesOrder->getAttribute('delivery.unit.type_name') }}</td>
                    <td>{{ $salesOrder->getAttribute('delivery.unit.chasis_number') }}</td>
                    <td>{{ $salesOrder->getAttribute('delivery.unit.engine_number') }}</td>
                    <td>{{ $salesOrder->getAttribute('delivery.unit.engine_number') }}</td>
                    <td>{{ $salesOrder->getAttribute('leasingOrder.application_number') }}</td>
                    <td>{{ $salesOrder->getAttribute('leasingOrder.po_number') }}</td>
                    <td>{{ $salesOrder->getAttribute('leasingOrder.tenor') }}</td>
                    <td>{{ $salesOrder->getAttribute('leasingOrder.dp_po') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection