geloraInventoryManagementShared
    .controller('UnitCurrentStockIndexController', function(
        UnitModel) {

        var vm = this

        vm.filter = {
            statuses_in: 'IN_STOCK_SELLABLE,IN_STOCK_NOT_SELLABLE,UNRECEIVED',
            include: 'currentLocation',
            paginate: 50
        }

        vm.data = {}

        vm.load = function(filter) {

            UnitModel.index(filter)
                .then(function(res) {

                    vm.units = _.map(res.data.data, function(unit) {
                        if (unit.currentLocation) {
                            unit.currentLocation = unit.currentLocation.data
                        }
                        return unit;
                    })
                })
        }
        vm.load(vm.filter)


    })