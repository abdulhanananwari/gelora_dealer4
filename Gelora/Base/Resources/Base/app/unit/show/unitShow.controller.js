geloraBase
	.controller('UnitShowController', function(
		$state,
		UnitModel) {

		var vm = this

		vm.id = $state.params.id

		UnitModel.get($state.params.id)
		.then(function(res) {
			vm.unit = res.data.data
		})
	})