geloraSalesAdmin
    .controller('SalesOrderShowRegistrationController', function(
        $state,
        SalesOrderModel) {

        var vm = this

        SalesOrderModel.get($state.params.id)
            .then(function(res) {
            	vm.salesOrder = res.data.data
            })
    })
