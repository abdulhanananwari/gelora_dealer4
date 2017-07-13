 @extends('layout.printing')

 @section('title' ,'Bukti Tagihan Leasing')
 
 @section('content')
   <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-xs-1">
                         <img style="width: auto; max-height: 5em !important;" class="img-responsive" src="{{ $viewData['tenantInfo']->LOGO }}">
                    </div>
                    <div class="col-xs-7">
                        <p><strong>{{ $viewData['tenantInfo']->TENANT }}</strong></p>
                        <p>{{ $viewData['tenantInfo']->ADDRESS }}</p>
                        <p>{{ $viewData['tenantInfo']->PHONE_NUMBER }}</p>
                    </div>
                    <div class="col-xs-4">
                        <p class="text-right">INVOICE LEASING {{$viewData['salesOrder']->id}}</p>
                        <img style="height: auto; max-width: 20em !important;" class="img-responsive pull-right" src="{{ $viewData['salesOrder']->retrieve()->barcode() }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <table width="100%">
                            <tr>
                                <td>Telah Terima Dari</td>
                                <td>:</td>
                                <td>{{ $viewData['leasingOrder']->mainLeasing['name'] }} | {{$viewData['leasingOrder']->customer['name'] }}</td>
                            </tr>
                            <tr>
                                <td>Untuk</td>
                                <td>:</td>
                                <td>{{ $viewData['leasingOrder']->vehicle['name'] }}</td>
                            </tr>
                            <tr>
                                <td>No Rangka</td>
                                <td>:</td>
                                <td>{{$viewData['unit']->chasis_number}}</td>
                            </tr>
                            <tr>
                                <td>No Mesin</td>
                                <td>:</td>
                                <td>{{$viewData['unit']->engine_number}}</td>
                            </tr>
                            <br>
                            <tr>
                                <td>On The Road</td>
                                <td></td>
                                <td>{{number_format($viewData['leasingOrder']->on_the_road)}}</td>
                            </tr>
                            <tr>
                                <td>Tanda Jadi</td>
                                <td></td>
                                <td>{{ number_format($viewData['leasingOrder']->dp_po) }}</td>
                            </tr>
                            <tr>
                                <td>Pelunasan</td>
                                <td></td>
                                <td>{{ number_format($viewData['leasingOrder']->on_the_road - $viewData['leasingOrder']->dp_po) }}</td>  
                            </tr>
                            <br>
                            <br>
                            <tr style="height: 8em;">
                                <td>{{$viewData['jwt']->name}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
 @endsection
 