@extends('layout.printing')

@section('title', 'Bukti Pembayaran')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xs-1">
                    <img style="width: 100% !important; height: auto;" src="{{ $viewData['tenantInfo']->LOGO }}">
                </div>
                <div class="col-xs-7">
                    <p><strong>{{ $viewData['tenantInfo']->TENANT }}</strong></p>
                    <p>{{ $viewData['tenantInfo']->ADDRESS }}</p>
                    <p>{{ $viewData['tenantInfo']->PHONE_NUMBER }}</p>
                </div>
                <div class="col-xs-4">
                    <p class="text-right"><strong>SURAT JALAN</strong></p>
                    <p class="text-right">{{ $viewData['salesOrder']->id }}</p>
                    <p class="text-right">No Faktur : {{$viewData['registration']->id}}</p>
                        <img style="width: auto; max-height: 3em !important; float: right; padding-right: 0px;" class="img-responsive" src="{{$viewData['registration']->generateBarcode() }}">
                </div>
            </div>
            <br>
            <p style="text-align: center;"><strong>Penagihan {{ $viewData['cost']['name'] }}</strong></p>
            <table width="100%">
                @if(isset($viewData['cost']['payer_name']))
                <tr>
                    <td>Telah Terima Dari</td>
                    <td>:</td>
                    <td>{{$viewData['cost']['payer_name']}}</td>
                </tr>
                @endif
                <tr>
                    <td>Jumlah</td>
                    <td>:</td>
                    <td><p><strong> Rp {{number_format($viewData['cost']['amount_to_charge_to_customer'])}}</strong></p></td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>{{\Carbon\Carbon::now('Asia/Jakarta')->format('d-m-Y')}}</td>
                </tr>
                <tr>
                    <td>Untuk Pembayaran</td>
                    <td>:</td>
                    <td><p><strong>{{$viewData['cost']['name']}}</strong></p></td>
                </tr>
                <tr>
                    <td>Cetakan Ke</td>
                    <td>:</td>
                    <td><p>{{$viewData['cost']['printed_count']}}</p></td>
                </tr>
                <tr>
                    <td>SOE ID</td>
                    <td>:</td>
                    <td><p>{{$viewData['cost']['sales_order_extra_id']}}</p></td>
                </tr>
                <tr>
                    <td>
                        <p>Dibuat Oleh</p>
                        <p style="padding-top: 3em;">{{$viewData['cost']['user']['name']}}</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection