 @extends('layout.printing')

 @section('title' ,'Bukti Penyerahan Barang')
 
 @section('content')

 @component('components.header', ['viewData' => $viewData])
    @slot('title')
        Tanda Terima Barang
    @endslot
@endcomponent

<div class="row">
    <h4 style="text-align: center;"><strong>Tanda Terima {{$viewData['item']['name']}} </strong></h4>
    <div class="col-xs-6">
        <table width="100%">
            <tr>
                <td>Telah Terima Dari</td>
                <td>:</td>
                <td>{{$viewData['tenantInfo']->TENANT}}</td>
            </tr>
            <tr>
                <td>Nama Barang</td>
                <td>:</td>
                <td><p><strong>{{ $viewData['item']['name'] }}</strong></p></td>
            </tr>
            <tr>
                <td>Penerima</td>
                <td>:</td>
                <td>{{ isset($viewData['outgoing']['receiver_name']) ? $viewData['outgoing']['receiver_name'] : '' }}</td>
            </tr>
            <tr>
                <td>Nomor KTP</td>
                <td>:</td>
                <td>{{ isset($viewData['outgoing']['receiver_id']) ? $viewData['outgoing']['receiver_id'] : '' }}</td>
            </tr>
            <tr>
                <td>Catatan</td>
                <td>:</td>
                <td>{{ isset($viewData['outgoing']['note']) ? $viewData['outgoing']['note'] : '' }}</td>
            </tr>
        </table>
    </div>
    <div class="col-xs-6">
        <table width="100%">
            <tr>
                <td>Tanggal Cetak</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::now('Asia/Jakarta')->toDateTimeString() }}</td>
            </tr>
            <tr>
                <td>Tanggal Serah Terima</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::createFromTimestamp($viewData['outgoing']['creator']['timestamp'])->toDateTimeString() }}</td>
            </tr>
        </table>
    </div>
    
</div>
<br>
<table width="100%">
    <tr>
        <td>
            <p>Dibuat Oleh</p>
            <p style="padding-top: 5em !important;">{{$viewData['outgoing']['creator']['name']}}</p>
        </td>
        <td>
            <p>Diterima Oleh</p>
            <p style="padding-top: 5em !important;">{{$viewData['outgoing']['receiver_name']}}</p>
        </td>
    </tr>
</table>

@endsection
