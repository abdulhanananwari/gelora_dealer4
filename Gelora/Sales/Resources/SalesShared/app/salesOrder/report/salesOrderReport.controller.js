geloraSalesShared
    .controller('SalesOrderReportController', function(
        SalesOrderModel, LinkFactory, JwtValidator) {

        var vm = this

        vm.filter = {}

        vm.download = function(filter) {

            vm.filter.jwt = JwtValidator.encodedJwt
            vm.filter.fields = _.flatMap(_.filter(vm.filter.fieldObjects, { checked: true }), 'name').join(',')

            var paramString = $.param(_.omit(vm.filter, ['fieldObjects']))

            console.log(paramString)

            window.open(LinkFactory.dealer.sales.salesOrder.report + '?' + paramString)
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
            'NAMA PILIHAN TYPE MOTOR',
            'KODE PILIHAN TYPE MOTOR',
            'NAMA PILIHAN WARNA MOTOR',
            'KODE PILIHAN WARNA MOTOR',
            'TAHUN PERAKITAN',
            'NOMOR RANGKA',
            'NOMOR MESIN',
            'TANGGAL DO',
            'PENUTUP',
            'NAMA TEAM SALES'
        ]

        vm.filter.fieldObjects = _.map(fields.sort(), function(field) {
            return {
                checked: false,
                name: field
            }
        })


    })