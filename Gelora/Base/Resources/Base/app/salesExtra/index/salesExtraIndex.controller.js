geloraBase
	.controller('SalesExtraIndexController', function(
	SalesExtraModel) {

		var vm = this

		vm.filter = {}

		vm.load = function() {

			SalesExtraModel.index(vm.filter)
			.then(function(res) {

				vm.salesExtras = res.data.data
			})

		}
		vm.load()

	})