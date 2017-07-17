geloraSalesAdmin
    .controller('SalesOrderIndexDeliveryController', function(
        SalesOrderModel, SettingModel,
        JwtValidator) {

        var vm = this

        vm.filter = {
            driver_id: JwtValidator.decodedJwt.sub,
            status: 'delivery_generated'
        }

        SettingModel.index({ object_type: 'DRIVERS', single: true })
            .then(function(res) {
                vm.drivers = res.data.data.data_1
            })

        vm.load = function(filter) {

            SalesOrderModel.index(filter)
                .then(function(res) {

                    vm.salesOrders = res.data.data
                })

        }
        vm.load(vm.filter)

    })