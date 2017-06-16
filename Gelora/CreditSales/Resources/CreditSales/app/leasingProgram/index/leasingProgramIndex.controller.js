geloraDealerCreditSales
	.controller('LeasingProgramIndexController', function(
		$state,
		LeasingProgramModel, LeasingModel,
		ModelModel) {

		var vm = this

		function assignData() {

			_.each(vm.leasingPrograms, function(leasingProgram) {
				leasingProgram.mainLeasing = _.find(vm.leasings, function(leasing) {
					return leasing.main_leasing_id == leasingProgram.main_leasing_id
				})
			})

			console.log(vm.leasingPrograms)
		}

		vm.load = function() {

			LeasingProgramModel.index()
			.success(function(data) {
				vm.leasingPrograms = data.data
				assignData()
			})
		}
		vm.load()

		LeasingModel.index()
		.success(function(data) {
			vm.leasings = data.data
			assignData()
		})


	})