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

                <table width="100%">
                    <tr>
                        <td style="width: 30%;">Nama Customer</td>
                        <td style="width: 70%; padding-left: 5px;">{{ $viewData['salesOrder']->customer['name'] }}</td>
                    </tr>
                    <tr>
                        <td>Penjualan</td>
                        <td>{{ $viewData['salesOrder']->id }}</td>
                    </tr>
                    <tr>
                        <td>Cetak</td>
                        <td>{{ \Carbon\Carbon::now()->toDateTimeString() }}</td>
                    </tr>
                    <tr>
                        <td>Untuk</td>
                        <td>{{ $viewData['salesOrder']->getAttribute('customerInvoice.note') }}</td>
                    </tr>
                    <tr>
                        <td>Sejumlah</td>
                        <td><strong>Rp {{ number_format($viewData['salesOrder']->getAttribute('customerInvoice.amount')) }}</strong>
                            <p></p>
                            <p></p>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ strtoupper(\Solumax\PhpHelperExtended\NumberWords::toBahasa($viewData['salesOrder']->getAttribute('customerInvoice.amount'),true)) }}</td>
                    </tr>
                </table>
                <br>
        <table style="width: 100%;" class="table-bordered">
            <tr style="height: 80px;" class="text-center">
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
        <?php

            $content = $viewData['tenantInfo']->PAYMENT_INSTRUCTION;
            $content = str_replace('**BANK**', $viewData['tenantInfo']->BANK, $content);
            $content = str_replace('**BANK_ACCOUNT_NUMBER**', $viewData['tenantInfo']->BANK_ACCOUNT_NUMBER, $content);
            $content = str_replace('**BANK_ACCOUNT_NAME**', $viewData['tenantInfo']->BANK_ACCOUNT_NAME, $content);
            $content = str_replace('**SPK_ID**', substr($viewData['salesOrder']->id, -5), $content);
        ?>
        <ul style="font-size: 12px;">         
            <li>{{$content}}</li>
        </ul>
    </div>
</div>

@endsection