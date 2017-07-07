geloraSalesShared
    .controller('SalesOrderShowLogController', function(
        $state,
        SalesOrderModel) {

        var vm = this

        SalesOrderModel.get($state.params.id)
            .then(function(res) {
                vm.salesOrder = res.data.data
            })

        vm.salesOrderId = $state.params.id
    })
