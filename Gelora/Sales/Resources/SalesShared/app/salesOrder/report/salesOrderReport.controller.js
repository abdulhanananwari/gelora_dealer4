geloraSalesShared
    .controller('SalesOrderReportController', function(
        SalesOrderModel, LinkFactory, JwtValidator) {

        var vm = this

        vm.filter = {}

        vm.download = function(filter) {

            vm.filter.jwt = JwtValidator.encodedJwt

            vm.filter.fields = _.flatMap(_.filter(vm.fields, { checked: true }), 'name').join(',')

            window.open(LinkFactory.dealer.sales.salesOrder.report + '?' + $.param(vm.filter))
        }

        var fields = [
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
            'NAMA TYPE MOTOR',
            'KODE TYPE MOTOR',
            'NAMA WARNA MOTOR',
            'KODE WARNA MOTOR',
            'TAHUN PERAKITAN',
            'NOMOR RANGKA',
            'NOMOR MESIN',
            'TANGGAL DO',
            'PENUTUP',
        ]

        vm.fields = _.map(fields.sort(), function(field) {
            return {
                checked: false,
                name: field
            }
        })


    })