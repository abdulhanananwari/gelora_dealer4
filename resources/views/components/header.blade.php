<?php
$headerData = [
    'tenantInfo' => (object) \Setting::where('object_type', 'TENANT_INFO')->first()->data_1,
];
?>

<div class="row">
    <div class="col-xs-1">
        <img style="width: auto; max-height: 5em !important;" class="img-responsive" src="{{ $headerData['tenantInfo']->LOGO }}">
    </div>
    <div class="col-xs-7">
        <p><strong>{{ $headerData['tenantInfo']->TENANT }}</strong></p>
        <p>{{ $headerData['tenantInfo']->ADDRESS }}</p>
        <p>{{ $headerData['tenantInfo']->PHONE_NUMBER }}</p>
    </div>
    <div class="col-xs-4">
        <p class="text-right"><strong>{{ isset($title) ? $title : null }}</strong></p>
        <p class="text-right">{{$viewData['salesOrder']->id}}</p>
        <img style="max-height: 20px !important; width: 5000px !important;" class="img-responsive pull-right" src="{{ $viewData['salesOrder']->retrieve()->barcode() }}">
    </div>
</div>
<hr>