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
                    'delivery.handover.created_at': 'Tanggal Serah Terima Kendaraan',
                    'delivery.handoverConfirmation.created_at': 'Tanggal BAST Serah Terima Kendaraan',
                    'leasingOrder.invoice_generated_at': 'Tanggal Tagih Leasing',
                    'customerInvoice.created_at': 'Tanggal Tagih Customer',
                    'leasingOrder.payment_at': 'Pembayaran Leasing',
                    'leasingOrder.payment_created_at': 'Inputan Pembayaran Leasing',
                }

                scope.statuses = {
                    'validated_at': 'Validasi',
                    'leasingOrder->order_confirmer->timestamp': 'ACC Lisan Leasing',
                    'leasingOrder->po_completer->timestamp': 'PO Lengkap',
                    'delivery->generated_at': 'Buat Surat Jalan',
                    'delivery->handover->created_at': 'Serah Terima Kendaraan',
                    'delivery->handoverConfirmation->created_at': 'BAST Serah Terima Kendaraan',
                    'leasingOrder->invoice_generated_at': 'Cetak Tagih Leasing',
                    'leasingOrder->leasing_invoice_batch_id': 'Kirim Tagihan Leasing',
                    'leasingOrder->payment_at': 'Pembayaran Tagihan Leasing',
                    'customerInvoice->created_at': 'Cetak Tagihan Customer',
                    'polReg->strings->created_at': 'Generate CDDB',
                    'polReg->md_submission_batch_id': 'Batch Faktur ke MD',
                    'polReg->agency_submission_batch_id': 'Batch Penyerahan ke Biro Jasa',
                    'polReg->agency_invoice_id': 'Batch Tagihan dari Biro Jasa',
                    'polReg->leasing_bpkb_submission_batch_id': 'Batch BPKB ke Leasing',
                    'mediator->payment->creator->timestamp': 'Pembayaran Fee Mediator',
                }

                ConfigModel.get('gelora.polReg.defaultItems')
                    .then(function(res) {
                        scope.defaultItems = res.data.data
                    })

                scope.statusFunctions = {
                    unset: function(code) {
                        _.unset(scope.filter, 'statuses.' + code)
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