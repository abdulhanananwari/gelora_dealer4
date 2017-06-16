geloraInventoryManagement
	.controller('UnitPdiController', function(
		$state,
		UnitModel) {

		var vm = this

		vm.pdi = function(unit, pdi_success, comment) {

			UnitModel.action.pdi(unit.id, {comment: comment, pdi_success: pdi_success})
			.then(function(res) {
				alert('Berhasil PDI')
			})
		}
		
		vm.scan = function () {
			var url = window.location.href.substr(0,  window.location.href.lastIndexOf("/") + 1)
            window.open('zxing://scan/?ret=' + encodeURIComponent(url +  '{CODE}'));
        }

		if ($state.params.chasisNumber) {

			UnitModel.index({chasis_number: $state.params.chasisNumber})
			.success(function (data) {
				if (data.data.length > 0) {
				
					vm.unit = data.data[0]
					
				} else {

					alert('Unit tidak ditemukan')
				}
			})
		}
	})