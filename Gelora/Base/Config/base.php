<?php

return [
    'unitStatuses' => [
            [
            'code' => 'UNRECEIVED',
            'name' => 'Belum Diterima',
        ],
            [
            'code' => 'IN_STOCK_SELLABLE',
            'name' => 'Stock (Ready)',
        ],
            [
            'code' => 'IN_STOCK_NOT_SELLABLE',
            'name' => 'Stock (Tidak Ready)',
        ],
            [
            'code' => 'SOLD_IN_PROGRESS',
            'name' => 'Terjual (Proses Penjualan)',
        ],
            [
            'code' => 'SOLD_COMPLETE',
            'name' => 'Terjual (Selesai)',
        ],
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
    'settings' => [
        'tenantInfo' => [
                [
                'name' => 'Tenant',
                'code' => 'TENANT',
                'type' => 'unique'
            ],
                [
                'name' => 'Address',
                'code' => 'ADDRESS',
                'type' => 'unique'
            ],
                [
                'name' => 'Nomor Telepon',
                'code' => 'PHONE_NUMBER',
                'type' => 'unique'
            ],
                [
                'name' => 'Logo',
                'code' => 'LOGO',
                'type' => 'unique'
            ],
                [
                'name' => 'Kode Dealer',
                'code' => 'DEALER_CODE',
                'type' => 'unique'
            ],
                [
                'name' => 'Bank',
                'code' => 'BANK',
                'type' => 'unique'
            ],
                [
                'name' => 'Nomor Bank Account',
                'code' => 'BANK_ACCOUNT_NUMBER',
                'type' => 'unique'
            ],
                [
                'name' => 'Nama Bank Account',
                'code' => 'BANK_ACCOUNT_NAME',
                'type' => 'unique'
            ],
                [
                'name' => 'Petunjuk Pembayaran',
                'code' => 'PAYMENT_INSTRUCTION',
                'type' => 'unique'
            ]
        ],
        'businessProcedure' => [
                [
                'name' => 'PO harus lengkap dan divalidasi',
                'code' => 'LEASING_ORDER_MUST_BE_COMPLETE',
                'type' => 'unique'
            ]
        ]
    ],
    'location' => [
        'types' => ['Gudang', 'POS', 'Pameran']
    ],
    'salesExtras' => [
        'types' => ['Hadiah', 'Kelengkapan']
    ]
];
