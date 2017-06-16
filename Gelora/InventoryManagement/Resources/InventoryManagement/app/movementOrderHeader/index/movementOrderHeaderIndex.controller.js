geloraInventoryManagement
	.controller('MovementOrderHeaderIndexController', function(
		$state,
		MovementOrderHeaderModel) {

		var vm = this

		vm.filter = {
			page: 1,
			paginate: 20,
			order: 'desc'
		}

		vm.load = function(page) {

			if (page) {
				vm.filter.page = page
			}

			MovementOrderHeaderModel.index(vm.filter)
			.then(function(res) {
				vm.movements = res.data.data
				vm.meta = res.data.meta
			})
		}
		vm.load()

	})