geloraSalesShared
    .controller('SalesOrderReportLeasingOrderController', function(
        SalesOrderModel) {

        var vm = this

        vm.filter = {
            time_type: 'leasingOrder.payment_at',
            order_by: 'leasingOrder.payment_at',
            order: 'asc',
            transformer: 'SubData\\LeasingOrderTransformer'
        }

        $('.date').datepicker({ dateFormat: "yy-mm-dd" });

        vm.load = function(filter) {

            SalesOrderModel.index(filter)
                .then(function(res) {
                    vm.salesOrders = res.data.data
                    calculateTotals(vm.salesOrders)
                })
        }

        function calculateTotals(salesOrders) {
            vm.totals = {
                leasingPayable: _.sumBy(salesOrders, 'leasingOrder.leasing_payable'),
                jpTotal: 0,
                jpTotalTransfer: 0,
                jpTotalTransferReal: 0 
            }

            _.each(salesOrders, function(salesOrder) {
                vm.totals.jpTotal += _.sumBy(salesOrder.leasingOrder.joinPromos, 'amount') || 0
                vm.totals.jpTotalTransfer += _.sumBy(salesOrder.leasingOrder.joinPromos, 'transfer_amount') || 0
                vm.totals.jpTotalTransferReal += _.sumBy(salesOrder.leasingOrder.joinPromos, 'transaction.amount') || 0
            })

            console.log(vm.totals)
        }


    })