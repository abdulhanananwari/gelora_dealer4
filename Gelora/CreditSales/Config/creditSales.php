<?php

return [
    
    'dueDateTypes' => [
        'LEASING_ORDER_INVOICE_GENERATED_AT' => 'Tanggal Tagih',
        'DUE_CLOSED_AT' => 'Pencairan Pokok Hutang Utama',
    ],
    
    'agreementBPKB' => [
            [
            'name' => 'Nama',
            'code' => 'NAME',
            'type' => 'unique',
        ],
            [
            'name' => 'Jabatan',
            'code' => 'POSITION',
            'type' => 'unique',
        ],
            [
            'name' => 'Alamat',
            'code' => 'ADDRESS',
            'type' => 'unique',
        ],
            [
            'name' => 'Nomor Telepon',
            'code' => 'PHONE_NUMBER',
            'type' => 'unique',
        ]
    ],
];
