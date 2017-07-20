@extends('layout.printing')

@section('title', 'Extra Dokumen Penagihan Leasing')

@section('content')

<style type="text/css">

    @page {
        size: Legal portrait !important;
        margin-top: 1cm;
    }

	.container {
		font-size: 10px !important;
	}
	
</style>

@if(isset($viewData['leasingOrder']->joinPromos )&& !empty($viewData['leasingOrder']->joinPromos ))
@component('gelora.sales::leasingOrder.partials.generateInvoiceJoinPromo' ,  ['viewData' => $viewData])
@endcomponent
@endif
<hr><br>
@component('gelora.sales::leasingOrder.partials.generateInvoiceDp' ,  ['viewData' => $viewData])
@endcomponent
<hr><br>
@component('gelora.sales::leasingOrder.partials.generateAgreementBpkb' ,  ['viewData' => $viewData])
@endcomponent

@endsection