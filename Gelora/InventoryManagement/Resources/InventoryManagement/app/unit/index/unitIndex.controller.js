geloraInventoryManagement
	.controller('UnitIndexController', function(
		UnitModel,
		ConfigModel, LinkFactory, JwtValidator) {

		var vm = this
		
		vm.filter = {
			paginate: 20,
			status_not: 'SOLD_COMPLETE',
			with: 'currentLocation'
		};
		
		vm.load = function() {

			UnitModel.index(vm.filter)
			.then(function(res){
				vm.units = res.data.data;
				vm.meta = res.data.meta;
			})
		}
		vm.load();

		vm.download = function() {

			var params = _.omit(vm.filter, ['paginate'])
			params.jwt = JwtValidator.encodedJwt

			window.open(LinkFactory.dealer.base.unit.report + '?' + $.param(params))
		}

		ConfigModel.get('gelora.base.unitStatuses')
		.then(function(res){
			vm.unitStatuses = res.data.data
			vm.unitStatuses.push({code: null, name: 'Semua'})
		})

	})