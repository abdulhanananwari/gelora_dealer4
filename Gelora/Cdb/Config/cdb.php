<?php

return [

    'cddbOptions' => [
    
        
        'customer_code' => [
            'options' => [
                'G' => 'Group Customer',
                'I' => 'Individual Customer (Reguler)',
                'J' => 'Individual Customer (Joint Promo)',
                'C' => 'Individual Customer (Kolektif)',
            ],
            'default' => 'I',
        ],
        
        'jenis_kelamin' => [
            'options' => [
                '1' => 'Laki Laki',
                '2' => 'Perempuan'
            ],
//            'default' => '1'
        ],
        
        'agama' => [
            'options' => [
                '1' => 'Islam',
                '2' => 'Kristen',
                '3' => 'Katolik',
                '4' => 'Hindu',
                '5' => 'Budha',
                '6' => 'Lain Lain',
            ],
//            'default' => '1'
        ],
        
        'pekerjaan' => [
            'options' => [
                '1' => 'Pegawai Negeri',
                '2' => 'Pegawai Swasta',
                '3' => 'Ojek',
                '4' => 'Wiraswasta / Pedagang',
                '5' => 'Mahasiswa / Pelajar',
                '6' => 'Guru / Dosen',
                '7' => 'TNI / Polri',
                '8' => 'Ibu Rumah Tangga',
                '9' => 'Petani / Nelayan',
                '11' => 'Lain Lain',
                '12' => 'Dokter',
                '13' => 'Pengacara',
                '14' => 'Wartawan',
            ],
//            'default' => '2'
        ],
        
        'pengeluaran' => [
            'options' => [
                '1' => ' <Rp 900.000,-',
                '2' => ' Rp 900.001,- s/d Rp 1.250.000,-',
                '3' => ' Rp 1.250.001,- s/d Rp 1.750.000,-',
                '4' => ' Rp 1.750.001,-s/d Rp 2.500.000,-',
                '5' => ' Rp 2.500.001,-s/d Rp 4.000.000,-',
                '6' => ' Rp 4.000.001,-s/d Rp 6.000.000,-',
                '7' => ' > Rp 6.000.000,-',
            ]
        ],
        
        'pendidikan' => [
            'options' => [
                '1' => ' Tidat Tamat SD',
                '2' => ' SD ',
                '3' => ' SLTP/SMP ',
                '4' => ' SLTA/SMU ',
                '5' => ' Akademi/Diploma ',
                '6' => ' Sarjana',
                '7' => ' Pasca Sarjana',
            ]
         ],
        
        'merk_motor_yang_dimiliki_sekarang' => [
            'options' => [
                '1' => ' Honda',
                '2' => ' Yamaha',
                '3' => ' Suzuki',
                '4' => ' Kawasaki',
                '5' => ' Motor lain',
                '6' => ' Belum pernah memiliki',
            ]
        ],
        
        'jenis_motor_yang_dimiliki_sekarang' => [
            'options' => [
                '1' => ' Sport',
                '2' => ' Cub (Bebek)',
                '3' => ' AT (Automatic)',
                '4' => ' Belum pernah memiliki',
            ]
        ],
        
        'sepeda_motor_digunakan_untuk' => [
            'options' => [
                '1' => ' Berdagang',
                '2' => ' Pemakaian jarak dekat',
                '3' => ' Ke Sekolah/ ke Kampus',
                '4' => ' Rekreasi/ Olah raga',
                '5' => ' Kebutuhan Keluarga',
                '6' => ' Lain-lain',
            ]
        ],
        
        'yang_menggunakan_sepeda_motor' => [
            'options' => [
                '1' => ' Saya sendiri',
                '2' => ' Anak',
                '3' => ' Pasangan (suami/ istri)',
                '4' => ' Lain-lain',
            ]
        ],
        
        'hobi' => [
            'options' => [
                'Kategori A ( Aktivitas )' => [
                    'A1' => ' Adventure (Petualangan )',
                    'A2' => ' Aeromodeling',
                    'A3' => ' Bercocok Tanam',
                    'A4' => ' Berkaraoke',
                    'A5' => ' Bermain Drama',
                    'A6' => ' Bermain Sulap',
                    'A7' => ' Fotografi',
                    'A8' => ' Kaligrafi',
                    'A9' => ' Koleksi Perangko (Filateli)',
                    'A10' => ' Makan',
                    'A11' => ' Massage',
                    'A12' => ' Melukis',
                    'A13' => ' Memancing',
                    'A14' => ' Memasak',
                    'A15' => ' Membaca',
                    'A16' => ' Membaca Puisi',
                    'A17' => ' Memelihara Binatang Peliharaan ',
                    'A18' => ' Menanam Bunga ',
                    'A19' => ' Menari ',
                    'A20' => ' Mendongeng',
                    'A21' => ' Mengaji',
                    'A22' => ' Mengarang Cerita ',
                    'A23' => ' Menggambar',
                    'A24' => ' Mengkoleksi Barang Antik ',
                    'A25' => ' Menjahit',
                    'A26' => ' Menulis Buku',
                    'A27' => ' Menyanyi ',
                    'A28' => ' Origami ',
                    'A29' => ' Otomotif ',
                    'A30' => ' Pantomim ',
                    'A31' => ' Shopping ',
                    'A32' => ' Surat Menyurat',
                    'A33' => ' Travelling ',
                ],
                'Kategori B ( Olahraga )' => [
                    'B1' => ' Badminton ',
                    'B2' => ' Basket',
                    'B3' => ' Bersepeda',
                    'B4' => ' Bowling ',
                    'B5' => ' Fitness',
                    'B6' => ' Golf ',
                    'B7' => ' Hiking ',
                    'B8' => ' Jogging ',
                    'B9' => ' Renang ',
                    'B10' => ' Senam',
                    'B11' => ' Sepakbola ',
                    'B12' => ' Sepatu Roda',
                    'B13' => ' Surfing ',
                    'B14' => ' Tennis ',
                    'B15' => ' Volley',
                    'B16' => ' Yoga',
                ],
                'Kategori C (Teknologi/Media )' => [
                    'C1' => ' Bermain Games ',
                    'C2' => ' Bermain Komputer ',
                    'C3' => ' Bermain Musik ',
                    'C4' => ' Browsing Internet',
                    'C5' => ' Chatting ',
                    'C6' => ' Mendengarkan Musik ',
                    'C7' => ' Mendengarkan Radio',
                    'C8' => ' Menonton Bioskop',
                    'C9' => ' Menonton Film ',
                    'C10' => ' Menonton TV ',
                ]
            ]
        ],
        'jenis_kartu' => [
            'options' =>[
                '1' => 'Asimo',
                '2' => 'Racing',
            ]

        ],
        'sms_broadcast' => [
            'options' =>[
                '1' => 'Bersedia',
                '2' => 'Tidak',
            ]

        ]
    ]
];