geloraSalesAdmin
    .controller('SalesOrderIndexIndentController', function(
        SalesOrderModel, SettingModel,
        JwtValidator) {

        var vm = this

        vm.filter = {
            status: 'indent',
            orderBy: 'indent.created_at',
            orderBy: 'asc',
        }

        vm.load = function(filter) {

            SalesOrderModel.index(filter)
                .then(function(res) {

                    vm.salesOrders = res.data.data
                })

        }
        vm.load(vm.filter)

    })