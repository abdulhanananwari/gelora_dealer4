geloraSalesShared
    .controller('SalesOrderReportLeasingOrderController', function(
        SalesOrderModel) {

        var vm = this

        vm.filter = {
            time_type: 'leasingOrder.payment_at',
            transformer: 'SubData\\LeasingOrderTransformer'
        }

        $('.date').datepicker({ dateFormat: "yy-mm-dd" });

        vm.load = function(filter) {

            SalesOrderModel.index(filter)
                .then(function(res) {
                    vm.salesOrders = res.data.data
                })
        }


    })