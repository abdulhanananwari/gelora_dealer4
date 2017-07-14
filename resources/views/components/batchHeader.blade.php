<?php
$headerData = [
    'tenantInfo' => (object) \Setting::where('object_type', 'TENANT_INFO')->first()->data_1,
];
?>

<div class="row">
    <div class="col-xs-2">
        <img style="height: 80px !important; width: : 80px !important;" src="{{ $headerData['tenantInfo']->LOGO }}">
    </div>
    <div class="col-xs-5">
        <p><strong>{{ $headerData['tenantInfo']->TENANT }}</strong></p>
        <p>{{ $headerData['tenantInfo']->ADDRESS }}</p>
        <p>{{ $headerData['tenantInfo']->PHONE_NUMBER }}</p>
    </div>
    <div class="col-xs-5">
        <p class="text-right"><strong>{{ isset($title) ? $title : null }}</strong></p>
        <p class="text-right"><strong>{{ isset($batchId) ? $batchId : null }}</strong></p>
    </div>
</div>
<hr>