geloraSalesShared
    .controller('SalesOrderIndexController', function(
        SalesOrderModel) {

        var vm = this

        vm.filter = {
            paginate: 20
        }

        vm.load = function(filter) {

        	vm.filter.page = 

            SalesOrderModel.index(filter)
                .then(function(res) {

                    vm.salesOrders = res.data.data
                    vm.meta = res.data.meta
                })
        }
        vm.load()
    })
