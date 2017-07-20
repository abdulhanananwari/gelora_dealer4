@component('components.headerMini', ['viewData' => $viewData])
    @slot('title')
        Invoice Subsidi Leasing
    @endslot
@endcomponent

    <div class="row">
    <div class="col-xs-12">
        <table width="100%">
            <tr>
                <td>Telah Terima Dari</td>
                <td>:</td>
                <td>{{$viewData['leasingOrder']->mainLeasing['name'] }} QQ {{$viewData['leasingOrder']->customer['name'] }}</td>
            </tr>
            <tr>
                <td>Uang Sejumlah</td>
                <td>:</td>
                <td>
                    <p>{{ number_format($viewData['leasingOrder']->joinPromos[0]['transfer_amount']) }}</p>
                    <p>{{ strtoupper(\Solumax\PhpHelperExtended\NumberWords::toBahasa( $viewData['leasingOrder']->joinPromos[0]['transfer_amount'],true)) }}</p>
                </td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td>
                    <p>Subsidi Leasing</p>
                    <p>No Rangka : {{ $viewData['salesOrder']->unit['chasis_number'] }}</p>
                    <p>No Mesin  : {{ $viewData['salesOrder']->unit['engine_number'] }}</p>
                </td>
            </tr>
            <tr>
                <td> Bandung , {{ \Carbon\Carbon::now()->toDateString() }}</td>
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