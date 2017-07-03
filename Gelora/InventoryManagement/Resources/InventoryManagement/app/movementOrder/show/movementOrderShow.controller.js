geloraInventoryManagement
    .controller('MovementOrderShowController', function(
        $state, JwtValidator,
        UnitModel,
        MovementOrderModel) {

        var vm = this

        vm.movementOrderHeader = {
            date: moment().format("YYYY-MM-DD"),
            units: []
        }

        $('#date').datepicker({ dateFormat: "yy-mm-dd" });

        vm.unitSearchAdditionalParams = {
            statuses_in: 'IN_STOCK_SELLABLE,IN_STOCK_NOT_SELLABLE',
        }

        vm.addUnit = function(unit) {

            // Validasi ini perlu dipindahkan ke laravel saja
            if (_.includes(_.map(vm.movementOrderHeader.units, 'id'), unit.id)) {
                alert('Unit sudah ada di perintah perpindahan ini')
                return;
            }

            vm.movementOrder.units.push(unit)
            _.unset(vm, 'unit')
        }

        vm.store = function(movement) {

            if (!movement.id) {

                MovementOrderModel.store(movement)
                    .then(function(res) {
                        $state.go('movementOrderShow', { id: res.data.data.id })
                    })

            } else {

                MovementOrderModel.update(movement.id, movement)
                    .then(function(res) {
                        assignData(res.data.data)
                        vm.unitSearchAdditionalParams.current_location_id_not = res.data.data.toLocation.id
                        alert('Data Berhasil Di Update')
                    })
            }
        }

        vm.close = function(movement) {

            MovementOrderModel.close(movement.id, movement)
                .then(function(res) {
                    assignData(res.data.data)
                    alert('Perpindahan Unit Telah Selesai')
                })
        }

        vm.print = function() {

            var w = window.open();

            window.setTimeout(function() {
                w.document.write($('#printarea').html());
            }, 2000);
        }

        vm.printData = {
            creatorName: JwtValidator.decodedJwt.name,
            template: 'app/movementOrder/print/print.html'
        }

        if ($state.params.id) {
            MovementOrderModel.get($state.params.id, {with:'units'})
                .then(function(res) {
                    assignData(res.data.data)
                    vm.unitSearchAdditionalParams.current_location_id_not = res.data.data.toLocation.id
                })
        }

        function assignData(data) {

            vm.movementOrder = data
            vm.movementOrder.units = data.units.data
        }


    })
