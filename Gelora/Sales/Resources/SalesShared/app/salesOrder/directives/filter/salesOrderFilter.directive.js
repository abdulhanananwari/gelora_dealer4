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
                scope.statuses = { 'unvalidated_and_indent': 'Belum Validasi & Indent Unit', 'unvalidated': 'Belum Validasi', 'validated': 'Validasi', 'delivery_generated': 'Sudah Buat Surat Jalan', 'delivery_handover_created': 'Sudah serah terima kendaraan', 'financial_unclosed': 'Konsumen yang belum lunas', 'financial_closed': 'Konsumen yang sudah lunas' }
                scope.dateTypes = { 'created_at': 'Tanggal SPK', 'indent.created_at': 'Tanggal Indent', 'validated_at': 'Tanggal Validasi', 'delivery.generated_at': 'Tanggal Buat Surat Jalan', 'delivery.handover.created_at': 'Tanggal Serah terima kendaraan', 'leasingOrder.invoice_generated_at': 'Tanggal Tagih Leasing', 'customerInvoice.created_at': 'Tanggal Tagih Customer' }

                ConfigModel.get('gelora.polReg.defaultItems')
                    .then(function(res) {
                        scope.defaultItems = res.data.data
                    })


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