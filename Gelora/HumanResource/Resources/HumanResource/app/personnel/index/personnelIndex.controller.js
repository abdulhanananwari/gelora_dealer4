geloraHumanResource
	.controller('PersonnelIndexController', function(
		$state,
		PersonnelModel) {

		var vm = this

		vm.load = function(page) {

			PersonnelModel.index({with: 'team', paginate: 15, page: page})
			.then(function(res) {
				vm.personnels = res.data.data
				vm.meta = res.data.meta
			})
		}
		vm.load(1)

		
	})