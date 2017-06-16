geloraBase
	.controller('SalesProgramIndexController', function(
	SalesProgramModel) {

		var vm = this

		vm.filter = {
			active: true
		}

		vm.load = function() {

			SalesProgramModel.index(vm.filter)
			.then(function(res) {

				vm.salesPrograms = res.data.data
			})

		}
		vm.load()

	})