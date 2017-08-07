@extends('layout.printing')

@section('title','Bukti Penyerahan Faktur Ke Biro Jasa')

@section('content')


@component('components.batchHeader', ['viewData' => $viewData])
    @slot('title')
        Penyerahan Faktur Ke Biro Jasa
    @endslot
    @slot('batchId')
        No Batch: {{$viewData['registrationBatch']->id}}
    @endslot
@endcomponent


        <div class="row">
            <div class="col-sm-12">
                <hr>
                <p style="text-align: center;"><strong>Penyerahan Dokumen Ke Biro Jasa {{ $viewData['registrationBatch']['agent']['name'] }}</strong></p>
                <br>
                
                <p>Catatan: {{ $viewData['registrationBatch']->agency_note }}</p>
                <br>

                <table width="100%" border="1" style="font-size: 12px !important;">
                    <tr>
                        <th>No Faktur</th>
                        <th>Nama STNK</th>
                        <th>Alamat STNK</th>
                        <th>Kode Tipe</th>
                        <th>Nomor Rangka</th>
                        <th>Nomor Mesin</th>
                        <th>Catatan</th>
                    </tr>
                    @foreach($viewData['registrationBatch']->getSalesOrders() as $salesOrder)
                    <tr>
                        <td>{{ $salesOrder->getAttribute('polReg.faktur_number')}}</td>
                        <td>{{ $salesOrder->getAttribute('registration.name') }}</td>
                        <td>{{ $salesOrder->getAttribute('registration.address') }}</td>
                        <td>{{ $salesOrder->unit->type_code }}</td>
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
                            <p>Bandung ,{{\Carbon\Carbon::now()->toDateString()}}</p>
                            <p>Karyawan Dealer</p>
                            <p style="padding-top: 4em !important;">{{ \ParsedJwt::getByKey('name') }}</p>
                        </td>
                        <td style="width: 50%;">
                            <p style="padding-bottom: 4em !important;">Perwakilan Biro Jasa</p>
                        </td>
                    </tr>
                </table>

            </div>
        </div>
    
@endsection