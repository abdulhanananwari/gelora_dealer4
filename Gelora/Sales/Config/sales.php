<?php

return [
    
    'customerTypes' => [
        'id' => [
            'KTP',
            'NPWP'
        ],
        'entity' => [
            'Perorangan',
            'Badan Usaha'
        ],
    ],
    
    'salesTypes' => [
        'condition' => [
                [
                'code' => 'isi',
                'name' => 'On The Road',
            ],
                [
                'code' => 'kosong',
                'name' => 'Off The Road',
            ]
        ],
        'payment' => [
                [
                'code' => 'credit',
                'name' => 'Kredit'
            ],
                [
                'code' => 'cash',
                'name' => 'Kas'
            ],
        ]
    ],
        'deliveryTypes' => [
            [
            'code' => 'IMMEDIATE_DELIVERY',
            'name' => 'Langsung',
        ],
            [
            'code' => 'PICKUP',
            'name' => 'Diambil',
        ],
            [
            'code' => 'DELIVER_AFTER_REGISTERED',
            'name' => 'Antar setelah STNK',
        ],
            [
            'code' => 'OTHERS',
            'name' => 'Lainnya (check request)',
        ]
    ],
    
    'accountTypes' => [
            [
            'code' => 'CASH',
            'name' => 'Kas Kasir',
        ],
            [
            'code' => 'BANK',
            'name' => 'Rekening Harian',
        ],
            [
            'code' => 'HUTANG',
            'name' => 'Hutang',
        ],
            [
            'code' => 'PIUTANG',
            'name' => 'Piutang',
        ],
    ],
    
    'salesOrderProgress' => [
        1 => 'Prospek',
        3 => 'Requested Lock',
        4 => 'Locked',
        5 => 'Validated',
    ],
    
    'prospectProgressQuery' => [
        'open' => 'Terbuka',
        'sales_order_request_created' => 'SPK request dibuat',
        'sales_order_request_not_created' => 'SPK request TIDAK dibuat',
        'sales_order_request_accepted' => 'SPK request diapprove',
        'sales_order_request_rejected' => 'SPK request tidak diapprove',
    ],
];
