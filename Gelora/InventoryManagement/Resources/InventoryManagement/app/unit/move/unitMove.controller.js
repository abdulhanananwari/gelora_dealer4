geloraInventoryManagement
	.controller('UnitMoveController', function(
		$state,
		UnitModel, LocationModel) {

		var vm = this

        vm.move = function (unit, newLocationId) {

            UnitModel.maintenance.moveLocation(unit.id, newLocationId)
            .then(function (res) {
                alert('Berhasil. Perpindahan unit sudah dibuat')
                _.unset(vm, 'unit')
            })
        }
        vm.scan = function () {

            var url = window.location.href.substr(0,  window.location.href.lastIndexOf("/") + 1)
            window.open('zxing://scan/?ret=' + encodeURIComponent(url +  '{CODE}'));
        }
       
		LocationModel.index()
		.then(function(res) {
			vm.locations = res.data.data
		})

        if ($state.params.chasisNumber) {

            UnitModel.index({chasis_number: $state.params.chasisNumber})
            .then(function (res) {

                if (res.data.data.length > 0) {
                
                    vm.unit = res.data.data[0]
                
                } else {
                
                    alert('unit tidak ditemukan')
                }
            })
        }
	})