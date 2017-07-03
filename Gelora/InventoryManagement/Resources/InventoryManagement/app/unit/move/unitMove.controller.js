geloraInventoryManagement
    .controller('UnitMoveController', function(
        $state,
        UnitModel, LocationModel) {

        var vm = this

        vm.scan = function() {
            var url = window.location.href.substr(0, window.location.href.lastIndexOf("/") + 1)
            window.open('zxing://scan/?ret=' + encodeURIComponent(url + '{CODE}'));
        }

        vm.goTolocationSelected = function() {
            $state.go('unitMove', { locationId: vm.storageLocation.id, chasisNumber: null })
        }

        vm.move = function(unit) {
            UnitModel.maintenance.moveLocation(unit.id, vm.storageLocation.id)
                .then(function(res) {
                    alert('Berhasil. Perpindahan unit sudah dibuat')
                    _.unset(vm, 'unit')
                })
        }

        if ($state.params.locationId) {

            LocationModel.get($state.params.locationId)
                .success(function(data) {
                    vm.storageLocation = data.data;
                })
        }

        if ($state.params.chasisNumber) {

            UnitModel.index({ chasis_number: $state.params.chasisNumber })
                .success(function(data) {
                    if (data.data.length > 0) {
                        vm.receive(data.data[0])
                    } else {
                        alert('unit tidak ditemukan')
                    }
                })
        }




    })
