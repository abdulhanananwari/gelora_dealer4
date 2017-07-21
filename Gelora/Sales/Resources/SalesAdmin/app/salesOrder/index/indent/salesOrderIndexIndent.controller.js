geloraSalesAdmin
    .controller('SalesOrderIndexIndentController', function(
        SalesOrderModel, UnitModel,
        SettingModel,
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

                    loadUnits()
                })

        }
        vm.load(vm.filter)

        function loadUnits() {

            var filter = {
                type_codes: _.flatMap(vm.salesOrders, 'vehicle.type_code').join(','),
                status: 'IN_STOCK_SELLABLE'
            }

            UnitModel.index(filter)
                .then(function(res) {
                    vm.units = res.data.data

                    _.each(vm.salesOrders, function(salesOrder) {
                        salesOrder.unitAvailability = {
                            by_model: _.filter(vm.units, {type_code: salesOrder.vehicle.code}).length,
                            by_model_and_color: _.filter(vm.units, {type_code: salesOrder.vehicle.code, color_code: salesOrder.vehicle.variant.code}).length
                        }
                    })
                })
        }

    })