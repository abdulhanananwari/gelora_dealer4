 @extends('layout.printing')

 @section('title' ,'Bukti Penyerahan Barang')
 
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
                            <p class="text-right"><strong>No SPK :{{ $viewData['salesOrder']->id }}</strong></p>
                            <img style="max-height: 5em !important; width: auto; right: 0;" class="pull-right" src="{{ $viewData['salesOrder']->retrieve()->barcode() }}" class="img-responsive">
                        </div>
                    </div>
                <hr>
                <h4 style="text-align: center;"><strong>Tanda Terima {{$viewData['item']['name']}} </strong></h4>
                <div class="row">
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
                            <p style="padding-top: 5em;">{{$viewData['outgoing']['creator']['name']}}</p>
                        </td>
                        <td>
                            <p>Diterima Oleh</p>
                            <p style="padding-top: 5em;">{{$viewData['outgoing']['receiver_name']}}</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

@endsection
