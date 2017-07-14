@extends('layout.printing')

@section('title', 'Bukti Tagihan Ke Konsumen')

@section('content')

@component('components.header', ['viewData' => $viewData ])
    @slot('title')
        Tagihan SPK
    @endslot
@endcomponent

        <div class="row">
            <div class="col-sm-12">
                <h2 class="text-center">INVOICE / TAGIHAN</h2>
                <div class="row">
                    <div class="col-xs-8">
                        <table width="100%">
                            <tr>
                                <td style="width: 50%;">Nama customer</td>
                                <td style="width: 50%; padding-left: 5px;">{{ $viewData['salesOrder']->customer['name'] }}</td>
                            </tr>
                            <tr>
                                <td style="font-size: 1.2em;">Total Terhutang</td>
                                <td style="padding-left: 5px;"><strong>Rp {{ number_format($viewData['balance']['payment_unreceived']) }}</strong></td>
                            </tr>
                            <tr>
                                <td style="font-size: 1.2em;">Total Tagihan Ini</td>
                                <td style="padding-left: 5px;"><strong>Rp {{ number_format($viewData['invoiceAmount'])}}</strong></td>
                            </tr>
                            
                            <tr>
                                <td>Untuk</td>
                                <td style="padding-left: 5px;">Pelunasan SPK {{ $viewData['salesOrder']->id }}</td>
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
                <hr>
                <br>
                <p><strong>Petunjuk Pembayaran:</strong></p>
                <ul>         
                    <li>Pembayaran menggunakan transfer bank harap dilakukan ke rekening <strong>{{ $viewData['tenantInfo']->BANK }}</strong> nomor account <strong>{{ $viewData['tenantInfo']->BANK_ACCOUNT_NUMBER }}</strong> atas nama <strong>{{ $viewData['tenantInfo']->BANK_ACCOUNT_NAME }}</strong> dengan mencantumkan keterangan: <strong>PEL SPK {{ substr($viewData['salesOrder']->id, -5) }}</strong></li>
                </ul>
                <br>
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
                    <tr class="text-center">
                        <td>
                            <p>{{ $viewData['jwt']->name }}</p>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
@endsection