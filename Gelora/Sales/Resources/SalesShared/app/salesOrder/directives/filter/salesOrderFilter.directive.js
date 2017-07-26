geloraSalesShared
    .directive('salesOrderFilter', function(
        $timeout,
        ConfigModel, SettingModel,
        SalesOrderModel) {

        return {
            restrict: "AE",
            templateUrl: '/gelora/sales-shared/app/salesOrder/directives/filter/salesOrderFilter.html',
            scope: {
                filter: '='
            },
            link: function(scope, element, attrs) {

                _.assignWith(scope.filter, {
                    order_by: 'created_at',
                    order: 'desc'
                })

                $('.date').datepicker({ dateFormat: "yy-mm-dd" });

                scope.customerTypes = ['Perorangan', 'Badan Usaha']

                scope.paymentTypes = { 'credit': 'Kredit', 'cash': 'Kas' }

                scope.statuses = {
                    'unvalidated_and_indent': 'Belum Validasi & Indent Unit',
                    'unvalidated': 'Belum Validasi',
                    'validated': 'Validasi',
                    'delivery_generated': 'Sudah Buat Surat Jalan',
                    'delivery_handover_created': 'Sudah Serah Terima Kendaraan',
                    'delivery_handover_confirmed': 'Sudah Serah Terima Kendaraan',
                    'financial_unclosed': 'Konsumen Yang Belum Lunas (financial_closed kosong)',
                    'financial_closed': 'Konsumen Yang Sudah Lunas (financial_closed isi)',
                    'delivery_generated_and_not_invoiced' : 'Sudah Buat Surat Jalan & Belum Cetak Tagihan Leasing',
                    'invoice_generated_and_not_batched' : 'Sudah Cetak Tagihan Leasing & Belum Kirim Leasing',
                    'leasing_order_invoice_batched': 'Sudah Kirim Leasing',
                    'polreg_cddb_string_generated': 'Sudah Generate CDDB',
                }

                scope.dateTypes = { 'created_at': 'Tanggal SPK', 'indent.created_at': 'Tanggal Indent', 'validated_at': 'Tanggal Validasi', 'delivery.generated_at': 'Tanggal Buat Surat Jalan', 'delivery.handover.created_at': 'Tanggal Serah terima kendaraan', 'leasingOrder.invoice_generated_at': 'Tanggal Tagih Leasing', 'customerInvoice.created_at': 'Tanggal Tagih Customer' }

                ConfigModel.get('gelora.polReg.defaultItems')
                    .then(function(res) {
                        scope.defaultItems = res.data.data
                    })


                scope.checkedStatusCodes = {}
                scope.checkStatus = function(code) {
                    if (!_.get(scope.checkedStatusCodes[code], 'checked')) {
                        scope.checkedStatusCodes[code] = {
                            status_code: code,
                            checked: true
                        }
                    } else {
                        scope.checkedStatusCodes[code] = {
                            status_code: code,
                            checked: false
                        }
                    }

                    scope.filter.statuses = _.flatMap(_.filter(scope.checkedStatusCodes, { checked: true }), 'status_code').join(',')
                }

                scope.loadDrivers = function() {

                    if (scope.drivers) { return }

                    SettingModel.index({ object_type: 'DRIVERS', single: true })
                        .then(function(res) {
                            scope.drivers = res.data.data.data_1
                        })
                }
            }
        }
    })