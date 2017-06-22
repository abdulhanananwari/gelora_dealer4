geloraSalesShared
    .controller('SalesOrderShowRegistrationController', function(
        $state,
        SalesOrderModel) {

        var vm = this

        SalesOrderModel.get($state.params.id)
            .then(function(res) {
                vm.salesOrder = res.data.data
            })


        vm.generateStrings = function(salesOrder) {

            SalesOrderModel.polReg.generateStrings(salesOrder.id)
                .then(function(res) {
                    vm.salesOrder = res.data.data
                    alert('String CDDB berhasil di generate')
                })
        }

    })
