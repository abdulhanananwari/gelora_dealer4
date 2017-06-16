geloraSalesAdmin
    .controller('SalesOrderShowExtraController', function(
        $scope, $state,
        SalesOrderModel, SalesOrderExtraSharedModel, SalesProgramModel,
        LinkFactory) {

        var vm = this

        function load() {

            vm.focused = null

            SalesOrderModel.get($state.params.id, { include: 'salesOrderExtras' })
                .then(function(res) {

                    vm.salesOrder = res.data.data
                    vm.salesOrder.salesOrderExtras = res.data.data.salesOrderExtras.data

                })
        }
        load()

        vm.storeFocused = function(salesOrderExtra) {

            salesOrderExtra.sales_order_id = vm.salesOrder.id

            if (salesOrderExtra.id) {

                SalesOrderExtraSharedModel.update(salesOrderExtra.id, salesOrderExtra)
                    .then(function() {
                        load()
                    })

            } else {

                SalesOrderExtraSharedModel.store(salesOrderExtra)
                    .then(function() {
                        load()
                    })
            }
        }
        
        SalesProgramModel.index({ active: true })
            .then(function(res) {
                vm.salesPrograms = res.data.data
            })

    })
