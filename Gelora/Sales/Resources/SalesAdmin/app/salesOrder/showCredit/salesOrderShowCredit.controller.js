geloraSalesAdmin
    .controller('SalesOrderShowCreditController', function(
        $state,
        LinkFactory,
        LeasingOrderModel,
        SalesOrderModel) {

        var vm = this

        var includes = { include: 'leasingOrders,selectedLeasingOrder' }

        LeasingOrderModel.index({ sales_order_id: 'null' })
            .then(function(res) {
                vm.leasingOrders = res.data.data

            })

        function loadSalesOrder() {

            SalesOrderModel.get($state.params.id, includes)
                .then(function(res) {

                    assignSalesOrder(res.data.data)

                })
        }
        loadSalesOrder()

        vm.attachLeasingOrder = function(leasingOrder) {

            LeasingOrderModel.salesOrder.attach(leasingOrder.id, vm.salesOrder, includes)
                .then(function(res) {
                    alert('PO berhasil disambungkan')
                    loadSalesOrder()
                })
        }

        vm.selectLeasingOrder = function(leasingOrder) {

            SalesOrderModel.leasingOrder.select(vm.salesOrder.id, leasingOrder, includes)
                .then(function(res) {
                    alert('Berhasil menjadikan PO ini sebagai yang digunakan')
                    assignSalesOrder(res.data.data)
                })
        }

        vm.deselectLeasingOrder = function(leasingOrder) {

            SalesOrderModel.leasingOrder.deselect(vm.salesOrder.id, includes)
                .then(function(res) {
                    alert('PO Berhasil dibatalkan')
                    assignSalesOrder(res.data.data)
                })
        }


        vm.openLeasingOrder = function(id, type) {

            var params = {}
            params[type] = id

            window.open(LinkFactory.dealer.creditSales.leasingOrder.redirectApp + '?' + $.param(params))
        }

        function assignSalesOrder(data) {

            vm.salesOrder = data

            if (data.leasingOrders) {
                vm.salesOrder.leasingOrders = data.leasingOrders.data
            }

            if (data.selectedLeasingOrder) {
                vm.salesOrder.selectedLeasingOrder = data.selectedLeasingOrder.data
            }
        }



    })
