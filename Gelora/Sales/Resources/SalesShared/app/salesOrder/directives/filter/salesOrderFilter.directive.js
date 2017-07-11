geloraSalesShared
    .directive('salesOrderFilter', function(
        $timeout,
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
                scope.statuses = { 'validated': 'Validasi', 'delivery_generated': 'Sudah Buat Surat Jalan', 'delivery_handover_created': 'Sudah serah terima kendaraan', 'financial_closed': 'Konsumen yang sudah lunas' }
                scope.dateTypes = { 'created_at': 'Tanggal SPK', 'validated_at': 'Tanggal Validasi', 'delivery.generated_at': 'Tanggal Buat Surat Jalan', 'delivery.handover.created_at': 'Tanggal Serah terima kendaraan' }
            }
        }
    })
