geloraSalesAdmin
    .controller('SalesOrderShowCreditController', function(
        $state, SalesOrderModel) {

        var vm = this

        SalesOrderModel.get($state.params.id)
            .then(function(res) {
                vm.salesOrder = res.data.data 
            })

        vm.store = function(salesOrder) {
            SalesOrderModel.leasingOrder.update(salesOrder.id, salesOrder.leasingOrder)
                .then(function(res) {
                    vm.salesOrder = res.data.data
                })
        }
    })
