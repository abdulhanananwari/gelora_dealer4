geloraSalesAdmin
    .controller('SalesOrderShowUnitController', function(
        $state,
        SalesOrderModel, ConfigModel) {

        var vm = this
        
        SalesOrderModel.get($state.params.id)
            .then(function(res) {
                vm.salesOrder = res.data.data
            })
    })
