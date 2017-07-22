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
@if($viewData['leasing']->getAttribute('generateDocuments.invoice_jp') && isset($viewData['leasingOrder']->joinPromos)&& !empty($viewData['leasingOrder']->joinPromos))
@component('gelora.sales::leasingOrder.partials.generateInvoiceJoinPromo' ,  ['viewData' => $viewData])
@endcomponent
@endif
<hr><br>
@if($viewData['leasing']->getAttribute('generateDocuments.invoice_dp'))
@component('gelora.sales::leasingOrder.partials.generateInvoiceDp' ,  ['viewData' => $viewData])
@endcomponent
@endif
<hr><br>
@if($viewData['leasing']->getAttribute('generateDocuments.agreement_bpkb'))
@component('gelora.sales::leasingOrder.partials.generateAgreementBpkb' ,  ['viewData' => $viewData])
@endcomponent
@endif
@endsection