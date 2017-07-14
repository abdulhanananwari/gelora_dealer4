@extends('layout.printing')

@section('title', 'SJ')

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
                        <p class="text-right">No Batch : {{$viewData['registrationBatch']->id}}</p>
                        <img style="height: auto; width: 100% !important; float: right;" class="img-responsive" src="{{$viewData['registrationBatch']->retrieve()->barcode() }}">
                    </div>
                </div>
                <br>
                <p class="text-center"><strong>Penyerahan BPKB ke Leasing {{$viewData['registrationBatch']['mainLeasing']['name']}}</strong></p><br>
                
                <table width="100%" border="1">
                    <tr>
                        <th>No BPKB</th>
                        <th>Plat Nomor</th>
                        <th>Nama Pemohon</th>
                        <th>Nama STNK</th>
                        <th>Alamat STNK</th>
                        <th>Tipe</th>
                        <th>Kode Tipe</th>
                        <th>Warna</th>
                        <th>Kode Warna</th>
                        <th>Nomor Rangka</th>
                        <th>Nomor Mesin</th>
                    </tr>
                    @foreach($viewData['registrationBatch']->getSalesOrders() as $salesOrder)
                    <tr>
                        <td>{{ $salesOrder->getAttribute('polReg.bpkb_number') }}</td>
                        <td>{{ $salesOrder->getAttribute('polReg.pol_reg') }}</td>
                        <td>{{ $salesOrder->getAttribute('customer.name') }}</td>
                        <td>{{ $salesOrder->getAttribute('registration.name') }}</td>
                        <td>{{ $salesOrder->getAttribute('registration.address') }}</td>
                        <td>{{ $salesOrder->unit->type_name }}</td>
                        <td>{{ $salesOrder->unit->type_code }}</td>
                        <td>{{ $salesOrder->unit->color_name }}</td>
                        <td>{{ $salesOrder->unit->color_code }}</td>
                        <td>{{ $salesOrder->unit->chasis_number }}</td>
                        <td>{{ $salesOrder->unit->engine_number }}</td>
                    </tr>
                    @endforeach
                </table><br>

                <p>Saya yang bertanda tangan dibawah ini perwakilan dari Leasing {{ $viewData['registrationBatch']['mainLeasing']['name'] }} menyatakan bahwa telah menerima BPKB dengan data motor-motor diatas.</p><br>

                <table width="100%">
                    <tr>
                        <td style="width: 50%;">
                            <p>Karyawan Dealer</p>
                            <br>
                            <br>
                            <p>{{ \ParsedJwt::getByKey('name') }}</p>
                        </td>
                        <td style="width: 50%;">
                            <p>Perwakilan Leasing</p>
                            <br><br><br>
                        </td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
@endsection