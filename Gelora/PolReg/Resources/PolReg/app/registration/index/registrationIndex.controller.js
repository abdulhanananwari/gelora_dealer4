geloraPolReg
	.controller('RegistrationIndexController', function(
		$state,
		RegistrationModel) {

		var vm = this

		vm.params = {
			paginate: 20
		}

		vm.load = function(page) {

			if (page) {
				vm.params.page = page
			}

			RegistrationModel.index(vm.params)
			.then(function(res) {
				vm.registrations = res.data.data
				vm.meta = res.data.meta
			})
		}
		vm.load(1)


	})