@extends('layout.printing')

@section('title', 'Invoice / Tagihan Konsumen')

@section('content')

@component('components.header', ['viewData' => $viewData ])
    @slot('title')
        Tagihan SPK
    @endslot
@endcomponent

<div class="row">
    <div class="col-sm-12">
        <h2 class="text-center" style="font-size: 18px;">INVOICE / TAGIHAN</h2>
        <div class="row">
            <div class="col-xs-8">
                <table width="100%">
                    <tr>
                        <td style="width: 50%;">Nama Customer</td>
                        <td style="width: 50%; padding-left: 5px;">{{ $viewData['salesOrder']->customer['name'] }}</td>
                    </tr>
                    <tr>
                        <td>Untuk</td>
                        <td>Pembayaran SPK {{ $viewData['salesOrder']->id }}</td>
                    </tr>
                    <tr>
                        <td>Total Terhutang</td>
                        <td>Rp {{ number_format($viewData['salesOrder']->getAttribute('customerInvoice.total_due')) }}</td>
                    </tr>
                    <tr style="font-size: 1.2em;">
                        <td>Total Tagihan Ini</td>
                        <td>
                            <p><strong>Rp {{ number_format($viewData['salesOrder']->getAttribute('customerInvoice.amount')) }}</strong></p>
                            <p>{{\Solumax\PhpHelperExtended\NumberWords::toBahasa($viewData['salesOrder']->getAttribute('customerInvoice.amount'),true)}}</p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-xs-4">
                <table width="100%">
                    <tr>
                        <td><p>Tanggal SPK: {{$viewData['salesOrder']->created_at->toDateTimeString() }}</p>
                            @if( $viewData['salesOrder']->validated_at )
                            <p>Tanggal Validasi: {{$viewData['salesOrder']->validated_at->toDateTimeString() }}</p>
                            @endif
                            <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->toDateTimeString() }}</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <table style="width: 100%;" class="table-bordered">
            <tr style="height: 100px;" class="text-center">
                <td style="width: 25%;" valign="top">
                    <p >Pembuat</p>
                </td>
                <td style="width: 25%;" valign="top">
                    <p >Mengetahui</p>
                </td>
                <td style="width: 25%;" valign="top">
                    <p >Yang Menerima</p>
                </td>
                <td style="width: 25%;" valign="top">
                    <p >Konsumen</p>
                </td>
            </tr>
            <tr class="text-center" style="font-size: 10px;">
                <td>
                    <p>{{ $viewData['jwt']->name }}</p>
                </td>
                <td>
                </td>
                <td>
                    <p>{{ $viewData['salesOrder']->getAttribute('customerInvoice.delegate.name') }}</p>
                    <p>({{ $viewData['salesOrder']->getAttribute('customerInvoice.delegate.type') }})</p>
                </td>
                <td>
                </td>
            </tr>
        </table>
        <br>
        <p><strong>Petunjuk Pembayaran:</strong></p>
        <ul style="font-size: 12px;">         
            <li>Pembayaran menggunakan transfer bank harap dilakukan ke rekening <strong>{{ $viewData['tenantInfo']->BANK }}</strong> nomor account <strong>{{ $viewData['tenantInfo']->BANK_ACCOUNT_NUMBER }}</strong> atas nama <strong>{{ $viewData['tenantInfo']->BANK_ACCOUNT_NAME }}</strong> dengan mencantumkan keterangan: <strong>PEL SPK {{ substr($viewData['salesOrder']->id, -5) }}</strong></li>
        </ul>
    </div>
</div>

@endsection