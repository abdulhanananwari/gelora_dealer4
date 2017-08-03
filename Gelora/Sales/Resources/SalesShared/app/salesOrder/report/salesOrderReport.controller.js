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

        vm.consoleLog = function(key, value) {
            console.log(key)
            console.log(value)
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
            'NAMA KIRIM',
            'ALAMAT KIRIM',
            'NOMOR TELEPON KIRIM',
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
            'TANGGAL TUTUP',
            'NAMA PILIHAN TYPE MOTOR',
            'KODE PILIHAN TYPE MOTOR',
            'NAMA PILIHAN WARNA MOTOR',
            'KODE PILIHAN WARNA MOTOR',
            'TAHUN PERAKITAN',
            'NOMOR RANGKA',
            'NOMOR MESIN',
            'TANGGAL DO',
            'PENUTUP',
            'NAMA TEAM SALES',
            'KOTA STNK',
            'KECAMATAN STNK',
            'KELURAHAN STNK',
            'KOTA ( UNTUK FAKTUR )',
            'KECAMATAN ( UNTUK FAKTUR )',
            'KELURAHAN ( UNTUK FAKTUR ) ',
            'ALAMAT (UNTUK FAKTUR )',
            'KODE POS STNK',
            'KODE POS ( UNTUK FAKTUR )'
        ]


    })