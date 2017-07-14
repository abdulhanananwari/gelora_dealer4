@extends('layout.printing')

@section('title' ,'Bukti Tagihan Leasing')

@section('content')

@component('components.header', ['viewData' => $viewData])
    @slot('title')
        Tagihan Leasing
    @endslot
@endcomponent

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
                <td>:</td>
                <td>{{number_format($viewData['leasingOrder']->on_the_road)}}</td>
            </tr>
            <tr>
                <td>Tanda Jadi</td>
                <td>:</td>
                <td>{{ number_format($viewData['leasingOrder']->dp_po) }}</td>
            </tr>
            <tr>
                <td>Pelunasan</td>
                <td>:</td>
                <td>{{ number_format($viewData['leasingOrder']->on_the_road - $viewData['leasingOrder']->dp_po) }}</td>  
            </tr>
            <tr style="height: 2em;">
                <td></td>
            </tr>
            <tr>
                <td>{{\Carbon\Carbon::now()->toDateString()}}</td>
            </tr>
            <tr style="height: 5em;">
                <td></td>
            </tr>
            <tr>
                <td>{{$viewData['jwt']->name}}</td>
            </tr>
        </table>
    </div>
</div>
@endsection
