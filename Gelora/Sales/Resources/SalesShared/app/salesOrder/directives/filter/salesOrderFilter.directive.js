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

                scope.paymentTypes = {
                    'credit': 'Kredit',
                    'cash': 'Kas'
                }

                scope.dateTypes = {
                    'created_at': 'Tanggal SPK',
                    'indent.created_at': 'Tanggal Indent',
                    'validated_at': 'Tanggal Validasi',
                    'delivery.generated_at': 'Tanggal Buat Surat Jalan',
                    'delivery.handover.created_at': 'Tanggal Serah terima kendaraan',
                    'delivery.handover.confirmed_at': 'Tanggal BAST Serah Terima Kendaraan',
                    'leasingOrder.invoice_generated_at': 'Tanggal Tagih Leasing',
                    'customerInvoice.created_at': 'Tanggal Tagih Customer'
                }

                var statuses = {
                    'validated_at': 'Validasi',
                    'leasingOrder.order_confirmer.timestamp': 'ACC Lisan Leasing',
                    'leasingOrder.po_completer.timestamp': 'PO Lengkap',
                    'delivery.generated_at': 'Buat Surat Jalan',
                    'delivery.handover.created_at': 'Serah Terima Kendaraan',
                    'delivery.handoverConfirmation.created_at': 'BAST Serah Terima Kendaraan',
                    'leasingOrder.invoice_generated_at': 'Cetak Tagih Leasing',
                    'leasingOrder.leasing_invoice_batch_id': 'Kirim Tagih Leasing',
                    'customerInvoice.created_at': 'Cetak Tagihan Customer',
                    'polReg.strings.created_at': 'Generate CDDB',
                    'polReg.md_submission_batch_id': 'Kirim Batch Faktur MD'
                }

                scope.statuses = _.map(statuses, function(value, key) {
                    return {
                        code: key,
                        name: value,
                    }
                })


                ConfigModel.get('gelora.polReg.defaultItems')
                    .then(function(res) {
                        scope.defaultItems = res.data.data
                    })

                scope.statusFunctions = {
                    changed: function() {
                        scope.filter.statuses = _.flatMap(_.filter(scope.statuses, function(status) {
                            return !_.isUndefined(status.checked)
                        }), function(checkedStatus) {
                            return checkedStatus.code + ':' + checkedStatus.checked
                        }).join(',')
                        console.log(scope.filter.statuses)
                    },
                    unset: function(status) {
                        _.unset(status, 'checked')
                        scope.statusFunctions.changed()
                    },
                }

                scope.$watch('rawCustomerArea', function(newValue) {
                    var strings = _.map(newValue, function(value, key) {
                        return key + ":" + value
                    })
                    if (strings) {
                        scope.filter.customer_area = strings.join(',')
                    }
                }, true)

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




// var statuses = {
//     'unvalidated_and_indent': 'Belum Validasi & Indent Unit',
//     'unvalidated': 'Belum Validasi',
//     'validated': 'Validasi',
//     'delivery_generated': 'Sudah Buat Surat Jalan',
//     'delivery_handover_created': 'Sudah Serah Terima Kendaraan',
//     'delivery_handover_confirmed': 'Sudah BAST Serah Terima Kendaraan',
//     'financial_unclosed': 'Konsumen Yang Belum Lunas (financial_closed kosong)',
//     'financial_closed': 'Konsumen Yang Sudah Lunas (financial_closed isi)',
//     'delivery_generated_and_not_invoiced': 'Sudah Buat Surat Jalan & Belum Cetak Tagihan Leasing',
//     'invoice_generated_and_not_batched': 'Sudah Cetak Tagihan Leasing & Belum Kirim Leasing',
//     'leasing_order_invoice_batched': 'Sudah Kirim Leasing',
//     'polreg_cddb_string_generated': 'Sudah Generate CDDB',
//     'polreg_md_submission_batched': 'Sudah di Batch Pengajuan Faktur',
// }