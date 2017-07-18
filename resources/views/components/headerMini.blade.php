<?php
$headerData = [
    'tenantInfo' => (object) \Setting::where('object_type', 'TENANT_INFO')->first()->data_1,
];
?>

<div class="row" style="font-size: 11px;">
    <div class="col-xs-2">
        <img style="height: 50px !important; width: : 50px !important;" src="{{ $headerData['tenantInfo']->LOGO }}">
    </div>
    <div class="col-xs-6">
        <p style="font-size: 14px;"><strong>{{ $headerData['tenantInfo']->TENANT }}</strong></p>
        <p>{{ $headerData['tenantInfo']->ADDRESS }}</p>
        <p>{{ $headerData['tenantInfo']->PHONE_NUMBER }}</p>
    </div>
    <div class="col-xs-2 text-right" style="font-size: 8px;">
        <p class="text-right"><strong>{{ isset($title) ? $title : null }}</strong></p>
        <p class="text-right">{{ substr($viewData['salesOrder']->id, 0, 12) }}</p>
        <p class="text-right">{{ substr($viewData['salesOrder']->id, 12, 12) }}</p>
    </div>
    <div class="col-xs-2">
        <img style="height: 50px !important; width: : 50px !important;" class="pull-right" src="{{ $viewData['salesOrder']->retrieve()->barcode(true) }}">
    </div>
</div>
<hr>