geloraInventoryManagement
	.controller('UnitIndexController', function(
		UnitModel, ConfigModel) {

		var vm = this
		
		vm.filter = {
			paginate: 20,
			statuses_not_in: 'SOLD_COMPLETE',
			with: 'currentLocation'
		};
		
		vm.load = function(unit) {

			UnitModel.index(vm.filter)
			.then(function(res){
				vm.units = res.data.data;
				vm.meta = res.data.meta;
			})
		}
		vm.load();

		ConfigModel.get('gelora.base.unitStatuses')
		.then(function(res){
			vm.unitStatuses = res.data.data
		})

	})