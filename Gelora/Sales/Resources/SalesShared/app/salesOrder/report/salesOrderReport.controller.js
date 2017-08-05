geloraSalesShared
    .controller('SalesOrderReportController', function(
        SalesOrderModel, LinkFactory, JwtValidator) {

        var vm = this

        vm.filter = {}

        vm.download = function(filter) {

            vm.filter.jwt = JwtValidator.encodedJwt

            var paramString = $.param(vm.filter)

            console.log(paramString)

            window.open(LinkFactory.dealer.sales.salesOrder.report + '?' + paramString)
        }

        vm.massUpdate = function(action) {

            if (typeof vm.filter.fields == 'undefined') { vm.filter.fields = {} }

            if (action) {

                _.each(vm.filteredFields, function(field) {
                    vm.filter.fields[field] = 'true'
                })

            } else {

                _.each(vm.filteredFields, function(field) {
                    vm.filter.fields[field] = 'false'
                })
            }
        }

        vm.fields = [
            'ID',
            'TANGGAL SPK',
            'TANGGAL SJ',
            'NAMA PEMOHON',
            'ALAMAT PEMOHON',
            'NOMOR TELEPON PEMOHON',
            'NOMOR KTP PEMOHON',
            'NAMA STNK',
            'ALAMAT STNK',
            'NOMOR TELEPON STNK',
            'NOMOR KTP STNK',
            'KOTA STNK',
            'KECAMATAN STNK',
            'KELURAHAN STNK',
            'KODE POS STNK',
            'NAMA KIRIM',
            'ALAMAT KIRIM',
            'NOMOR TELEPON KIRIM',
            'NAMA PENERIMA',
            'NOMOR TELEPON PENERIMA',
            'CATATAN PENERIMAAN',
            'FOTO KTP PENERIMA',
            'FOTO SERAH TERIMA',
            'WAKTU SERAH TERIMA',
            'LATITUDE SERAH TERIMA',
            'LONGITUDE SERAH TERIMA',
            'WAKTU BASTK',
            'ADMIN BASTK',
            'EXTRA',
            'NOMOR PO',
            'NOMOR APLIKASI',
            'TANGGAL PO',
            'LEASING UTAMA',
            'LEASING CABANG',
            'TANGGAL CETAK TAGIHAN LEASING',
            'TANGGAL KIRIM TAGIHAN LEASING',
            'PIUTANG LEASING',
            'SUBSIDI LEASING',
            'JOIN PROMO',
            'DP PO',
            'DP KUSTOMER',
            'TENOR',
            'CICILAN',
            'KONDISI JUAL',
            'JENIS PENJUALAN',
            'ON THE ROAD',
            'OFF THE ROAD',
            'DISCOUNT',
            'MEDIATOR',
            'ID SALES',
            'NAMA SALES',
            'NAMA TEAM SALES',
            'NAMA PILIHAN TYPE MOTOR',
            'KODE PILIHAN TYPE MOTOR',
            'NAMA PILIHAN WARNA MOTOR',
            'KODE PILIHAN WARNA MOTOR',
            'TAHUN PERAKITAN',
            'NOMOR RANGKA',
            'NOMOR MESIN',
            'TANGGAL DO',
            'KOTA ( UNTUK FAKTUR )',
            'KECAMATAN ( UNTUK FAKTUR )',
            'KELURAHAN ( UNTUK FAKTUR ) ',
            'ALAMAT (UNTUK FAKTUR )',
            'KODE POS ( UNTUK FAKTUR )'
        ]


    })