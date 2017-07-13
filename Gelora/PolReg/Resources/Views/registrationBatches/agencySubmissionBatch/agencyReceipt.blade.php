@extends('layout.printing')

@section('title','Bukti Penyerahan Faktur Ke Biro Jasa')

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
                        <p style="float: right;padding-right: 55px;">No Batch : {{$viewData['registrationBatch']->id}}</p>
                        <img style="width: auto; max-height: 4em !important; float: right;" class="img-responsive" src="{{$viewData['registrationBatch']->retrieve()->barcode() }}">
                    </div>
                </div>
                <hr>
                <p style="text-align: center;"><strong>Penyerahan Dokumen Ke Biro Jasa</strong></p>
                <br>
                
                <p>Catatan: {{ $viewData['registrationBatch']->agency_note }}</p>
                <br>

                <table width="100%" border="1">
                    <tr>
                        <th>No Faktur</th>
                        <th>Nama Pemohon</th>
                        <th>Nama STNK</th>
                        <th>Alamat STNK</th>
                        <th>Tipe</th>
                        <th>Kode Tipe</th>
                        <th>Warna</th>
                        <th>Kode Warna</th>
                        <th>Nomor Rangka</th>
                        <th>Nomor Mesin</th>
                        <th>Catatan</th>
                    </tr>
                    @foreach($viewData['registrationBatch']->getSalesOrders() as $salesOrder)
                    <tr>
                        <td>{{ $salesOrder->getAttribute('polReg.faktur_number')}}</td>
                        <td>{{ $salesOrder->getAttribute('customer.name') }}</td>
                        <td>{{ $salesOrder->getAttribute('registration.name') }}</td>
                        <td>{{ $salesOrder->getAttribute('registration.address') }}</td>
                        <td>{{ $salesOrder->unit->type_name }}</td>
                        <td>{{ $salesOrder->unit->type_code }}</td>
                        <td>{{ $salesOrder->unit->color_name }}</td>
                        <td>{{ $salesOrder->unit->color_code }}</td>
                        <td>{{ $salesOrder->unit->chasis_number }}</td>
                        <td>{{ $salesOrder->unit->engine_number }}</td>
                        <td>{{ $salesOrder->getAttribute('polReg.agency_note') }}</td>
                    </tr>
                    @endforeach
                </table><br>

                <p>Saya yang bertanda tangan dibawah ini perwakilan dari biro jasa {{ $viewData['registrationBatch']['agent']['name'] }} menyatakan bahwa telah menerima lengkap seluruh dokumen untuk melakukan proses PolReg motor-motor diatas.</p><br>

                <table width="100%">
                    <tr>
                        <td style="width: 50%;">
                            <p>Karyawan Dealer</p>
                            <p style="padding-top: 4em;">{{ \ParsedJwt::getByKey('name') }}</p>
                        </td>
                        <td style="width: 50%;">
                            <p>Perwakilan Biro Jasa</p>
                        </td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
    
@endsection